<?php 
// Include the initialization script, which sets up constants, functions, and database connections
require_once('../../../private/initialize.php'); 
?>

<?php
// Retrieve the 'id' parameter from the URL query string
// If no 'id' is passed, default to '1'
$id = $_GET['id'] ?? '1';

// Basic input validation to ensure the ID is a digit
// If it's not a valid numeric ID, fallback to '1' to avoid errors or malicious input
if (!ctype_digit($id)) {
  // Optional: In a real app, you might redirect to an error page or display an error message
  $id = '1';
}
?>

<?php 
// Set the page title that will be used in the header template
$page_title = 'Show Page'; 
?>

<?php 
// Include the shared header file for the staff section
include(SHARED_PATH . '/staff_header.php'); 
?>

<div id="content">

  <!-- Back link to the list of pages -->
  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page show">
    <!-- Output the sanitized page ID to prevent XSS -->
    <p>Page ID: <?php echo h($id); ?></p>
  </div>

</div>

<?php 
// Include the shared footer file for the staff section
include(SHARED_PATH . '/staff_footer.php'); 
?>
