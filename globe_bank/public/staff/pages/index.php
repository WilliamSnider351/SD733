<?php
  // Load core configuration, functions, and constants
  // This file sets up things like SHARED_PATH and url_for() helper
  require_once('../../../private/initialize.php');

  // Define an array of pages, simulating data that might come from a database
  // Each page is represented as an associative array with keys: id, position, visible, menu_name
  $pages = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'Globe Bank'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'History'],
    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Leadership'],
    ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Contact Us'],
  ];

  // Set a page title variable used in the shared header template
  $page_title = 'Pages';

  // Include the shared staff header (contains HTML head, nav, etc.)
  include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
  <div class="pages listing">
    <h1>Pages</h1>

    <div class="actions">
      <!-- Link to create a new page (href empty for now) -->
      <a class="action" href="#">Create New Page</a>
    </div>

    <!-- Start of the pages list table -->
    <table class="list">
      <tr>
        <!-- Table headers -->
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
        <th>Name</th>
        <th colspan="3">Actions</th> <!-- Combined header for the 3 action columns -->
      </tr>

      <?php 
        // Loop through each page in the $pages array to generate a table row
        foreach ($pages as $page) { 
      ?>
        <tr>
          <td><?php echo h($page['id']); ?></td>
          <td><?php echo h($page['position']); ?></td>
          <td><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></td>
          <td><?php echo h($page['menu_name']); ?></td>
          <td>
            <a class="action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id']))); ?>">
              View
            </a>
          </td>
          <td><a class="action" href="#">Edit</a></td>
          <td><a class="action" href="#">Delete</a></td>
        </tr>
      <?php 
        } // End foreach loop 
      ?>
    </table>
  </div>
</div>

<?php 
  include(SHARED_PATH . '/staff_footer.php'); 
?>
