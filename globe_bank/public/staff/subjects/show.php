<?php 
// Initialize core settings and functions for the application
require_once('../../../private/initialize.php'); 
?>

<?php
// Retrieve the subject ID from the URL query string (e.g., show.php?id=3)
// Use '1' as a fallback if no ID is provided
$id = $_GET['id'] ?? '1';
?>

<?php 
// Set the dynamic page title, used in the shared header
$page_title = 'Show Subject'; 
?>

<?php 
// Include the shared page header (opening HTML tags, navigation, etc.)
include(SHARED_PATH . '/staff_header.php'); 
?>

<div id="content">

  <!-- Link to return to the index/listing page for subjects -->
  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject show">
    <!-- Output the subject ID, safely encoded for HTML -->
    Subject ID: <?php echo h($id); ?>
  </div>

</div>

<?php 
// Include the shared footer (closing tags and layout footer)
include(SHARED_PATH . '/staff_footer.php'); 
?>
