<?php
require_once('../../../private/initialize.php');

$menu_name = '';
$position = '';
$visible = '0';
$errors = [];

if (is_post_request()) {
    // Sanitize and assign POST data
    $menu_name = trim($_POST['menu_name'] ?? '');
    $position = $_POST['position'] ?? '';
    $visible = isset($_POST['visible']) ? '1' : '0';

    // Validation
    if ($menu_name == '') {
        $errors[] = "Menu name cannot be blank.";
    }
    if (!is_numeric($position) || $position < 1 || $position > 20) {
        $errors[] = "Position must be a number between 1 and 20.";
    }

    // If no errors, insert into DB
    if (empty($errors)) {
        $sql = "INSERT INTO pages (menu_name, position, visible) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "sii", $menu_name, $position, $visible);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            redirect_to(url_for('/staff/pages/index.php'));
        } else {
            $errors[] = "Database insert failed: " . mysqli_error($db);
        }
    }
}

?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page new">
    <h1>Create Page</h1>

    <?php if (!empty($errors)) { ?>
      <div class="errors">
        <ul>
          <?php foreach ($errors as $error) {
            echo "<li>" . h($error) . "</li>";
          } ?>
        </ul>
      </div>
    <?php } ?>

    <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
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
                $selected = ($position == (string)$i) ? 'selected' : '';
                echo "<option value=\"$i\" $selected>$i</option>";
            }
            ?>
          </select>
        </dd>
      </dl>

      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="checkbox" name="visible" value="1" <?php if ($visible === '1') echo "checked"; ?> />
        </dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
