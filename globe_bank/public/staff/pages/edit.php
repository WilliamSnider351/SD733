<?php

// Include initialization code and functions
require_once('../../../private/initialize.php');

// Redirect to index if no ID is provided in the query string
if (!isset($_GET['id'])) {
  redirect_to(url_for('/staff/pages/index.php'));
}

// Get the ID of the page being edited
$id = $_GET['id'];

// Initialize form fields
$menu_name = '';
$position = '';
$visible = '';

// Process form submission
if (is_post_request()) {
  // Get values from POST data, using null coalescing to avoid undefined index warnings
  $menu_name = $_POST['menu_name'] ?? '';
  $position = $_POST['position'] ?? '';
  $visible = $_POST['visible'] ?? '';

 // Display submitted form parameters for debugging BEFORE HTML output
  echo "<div style=\"padding:1rem; background-color:white; font-size:1rem; line-height:1.2;\">";
  echo "Form parameters<br>";
  echo "Menu name: " . htmlspecialchars($menu_name) . "<br>";
  echo "Position: " . htmlspecialchars($position) . "<br>";
  echo "Visible: " . htmlspecialchars($visible) . "<br>";
  echo "</div>";
}

?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page edit">
    <h1>Edit Page</h1>

<!-- Page edit form -->
<form action="<?php echo url_for('/staff/pages/edit.php?id=' . htmlspecialchars(urlencode($id))); ?>" method="post">
  <dl>
    <dt>Menu Name</dt>
    <dd>
      <input type="text" name="menu_name" value="<?php echo htmlspecialchars($menu_name); ?>" required />
    </dd>
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
      <input type="hidden" name="visible" value="0" />
      <input type="checkbox" name="visible" value="1" <?php if ($visible == "1") { echo "checked"; } ?> />
    </dd>
  </dl>

  <div id="operations">
    <input type="submit" value="Edit Page" />
  </div>
</form>
    
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
