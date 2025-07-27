<?php require_once('../../../private/initialize.php'); ?>

<?php
// Initialize values
$menu_name = '';
$position = '';
$visible = '0'; // Default visible to '0' (not visible)
$errors = []; // Array to hold validation errors

if (is_post_request()) {
  // Sanitize and assign form inputs
  $menu_name = trim($_POST['menu_name'] ?? '');
  $position = $_POST['position'] ?? '';
  $visible = isset($_POST['visible']) ? '1' : '0'; // Checkbox returns '1' if checked, else '0'

  // Display submitted form parameters for debugging BEFORE HTML output
  echo "<div style=\"padding:1rem; background-color:white; font-size:1rem; line-height:1.2;\">";
  echo "Form parameters<br>";
  echo "Menu name: " . htmlspecialchars($menu_name) . "<br>";
  echo "Position: " . htmlspecialchars($position) . "<br>";
  echo "Visible: " . htmlspecialchars($visible) . "<br>";
  echo "</div>";
}
?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <!-- Back link to pages index -->
  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page new">
    <h1>Create Page</h1>

    <!-- Page creation form -->
    <form action="new.php" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo htmlspecialchars($menu_name); ?>" required /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position" required>
            <option value="">--Select--</option>
            <?php
            // Generate position options dynamically
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
          
          <!-- Checkbox for visibility -->
          <input type="checkbox" name="visible" value="1" <?php if ($visible == "1") echo "checked"; ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
