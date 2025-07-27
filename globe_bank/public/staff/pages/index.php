<?php require_once('../../../private/initialize.php'); ?>

<?php
  $pages = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'Globe Bank'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'History'],
    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Leadership'],
    ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Contact Us'],
  ];
  // Each element in $pages represents one page record with its associated properties
?>

<?php $page_title = 'Pages'; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>
<!-- Includes the standard header for staff pages from shared path -->

<div id="content">
  <div class="pages listing">
    <h1>Pages</h1>
    <!-- Title for the listing -->

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/pages/new.php'); ?>">Create New Page</a>
      <!-- Link to add a new page; url_for() helps create proper URL with root path -->
    </div>

    <table class="list">
      <tr>
        <!-- Table headers -->
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
        <th>Name</th>
        <th>&nbsp;</th> <!-- For View link -->
        <th>&nbsp;</th> <!-- For Edit link -->
        <th>&nbsp;</th> <!-- For Delete link -->
      </tr>

      <?php foreach($pages as $page) { ?>
        <!-- Loop through each page and create a row in the table -->
        <tr>
          <td><?php echo h($page['id']); ?></td>
          <td><?php echo h($page['position']); ?></td>
          <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
          <td><?php echo h($page['menu_name']); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id']))); ?>">Edit</a></td>
          <td><a class="action" href="">Delete</a></td>
        </tr>
      <?php } ?>
    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
<!-- Includes the standard footer for staff pages -->
