<?php
require_once('../../../private/initialize.php');

// Redirect if no ID provided
if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];
$errors = [];

if (is_post_request()) {
    // Debug: log the incoming POST data for visible
    error_log('POST data for visible: ' . ($_POST['visible'] ?? 'not set'));

    // Get and sanitize POST data
    $menu_name = trim($_POST['menu_name'] ?? '');
    $position = $_POST['position'] ?? '';
    // Checkbox handling: if checkbox is checked, $_POST['visible'] is '1', else it's missing
    $visible = isset($_POST['visible']) && $_POST['visible'] === '1' ? 1 : 0;

    // Validation
    if ($menu_name == '') {
        $errors[] = "Menu name cannot be blank.";
    }
    if (!is_numeric($position) || $position < 1 || $position > 20) {
        $errors[] = "Position must be a number between 1 and 20.";
    }

    if (empty($errors)) {
        $sql = "UPDATE pages SET menu_name=?, position=?, visible=? WHERE id=?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "siii", $menu_name, $position, $visible, $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            redirect_to(url_for('/staff/pages/index.php'));
        } else {
            $errors[] = "Database update failed: " . mysqli_error($db);
        }
    }
} else {
    // Load existing data for form
    $sql = "SELECT * FROM pages WHERE id=?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $page = mysqli_fetch_assoc($result);

    if (!$page) {
        redirect_to(url_for('/staff/pages/index.php'));
    }

    $menu_name = $page['menu_name'];
    $position = $page['position'];
    $visible = $page['visible'];
}
?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page edit">
    <h1>Edit Page</h1>

    <?php if (!empty($errors)) { ?>
      <div class="errors">
        <ul>
          <?php foreach ($errors as $error) {
            echo "<li>" . h($error) . "</li>";
          } ?>
        </ul>
      </div>
    <?php } ?>

    <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($menu_name); ?>" required /></dd>
      </dl>

      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position" required>
            <option value="">--Select--</option>
            <?php
            for ($i = 1; $i <= 20; $i++) {
                $selected = ($position == $i) ? 'selected' : '';
                echo "<option value=\"$i\" $selected>$i</option>";
            }
            ?>
          </select>
        </dd>
      </dl>

      <dl>
        <dt>Visible</dt>
        <dd>
          <!-- Hidden input ensures '0' sent if checkbox unchecked -->
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php if ($visible == 1) echo "checked"; ?> />
        </dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
