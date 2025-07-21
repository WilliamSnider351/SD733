<?php 
// Load core configuration and helper functions
require_once('../../private/initialize.php'); 
?>

<?php 
// Set the dynamic title for this page, used in the <title> tag of the header
$page_title = 'Staff Menu'; 
?>

<?php 
// Include shared HTML header (opening tags, navigation, styles, etc.)
include(SHARED_PATH . '/staff_header.php'); 
?>

<div id="content">
  <div id="main-menu">
    <h2>Main Menu</h2>
    
    <!-- Navigation links to main sections of the staff admin area -->
    <ul>
      <!-- Use the url_for() helper to generate relative URLs -->
      <li><a href="<?php echo url_for('/staff/subjects/index.php'); ?>">Subjects</a></li>
      <li><a href="<?php echo url_for('/staff/pages/index.php'); ?>">Pages</a></li>
    </ul>
  </div>
</div>

<?php 
// Include shared HTML footer (closing tags and footer markup)
include(SHARED_PATH . '/staff_footer.php'); 
?>
