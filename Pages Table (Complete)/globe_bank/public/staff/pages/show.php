<?php
require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1';
$id = (int)$id; // cast to integer for safety

// Fetch the page from DB
$sql = "SELECT * FROM pages WHERE id = ?";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$page = mysqli_fetch_assoc($result);

if (!$page) {
    redirect_to(url_for('/staff/pages/index.php'));
}
?>

<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page show">
    <h1>Page Details</h1>

    <dl>
      <dt>ID</dt>
      <dd><?php echo h($page['id']); ?></dd>
    </dl>

    <dl>
      <dt>Menu Name</dt>
      <dd><?php echo h($page['menu_name']); ?></dd>
    </dl>

    <dl>
      <dt>Position</dt>
      <dd><?php echo h($page['position']); ?></dd>
    </dl>

    <dl>
      <dt>Visible</dt>
      <dd><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></dd>
    </dl>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
