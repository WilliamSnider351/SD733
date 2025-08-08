<?php
require_once('../../../private/initialize.php');

if (!isset($_GET['id'])) {
  redirect_to(url_for('/staff/pages/index.php'));
}

$id = (int) $_GET['id'];

if (is_post_request()) {
  // Delete record
  $sql = "DELETE FROM pages WHERE id = ?";
  $stmt = mysqli_prepare($db, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id);
  $result = mysqli_stmt_execute($stmt);

  if ($result) {
    // Success: redirect back to index
    redirect_to(url_for('/staff/pages/index.php'));
  } else {
    die("Delete failed: " . mysqli_error($db));
  }
} else {
  // Show delete confirmation form
  $sql = "SELECT * FROM pages WHERE id = ?";
  $stmt = mysqli_prepare($db, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $page = mysqli_fetch_assoc($result);

  if (!$page) {
    redirect_to(url_for('/staff/pages/index.php'));
  }
}

?>

<?php $page_title = 'Delete Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page delete">
    <h1>Delete Page</h1>

    <p>Are you sure you want to delete this page?</p>
    <p><strong><?php echo h($page['menu_name']); ?></strong></p>

    <form action="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($id))); ?>" method="post">
      <input type="submit" value="Delete Page" />
    </form>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
