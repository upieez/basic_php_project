<?php include_once('../../../private/initialize.php'); ?>

<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php
    $id = $_GET['id'] ?? '1';
    $page = find_page_by_id($id);
?>

<div id="content">
    <div><a href="<?php echo url_for('/staff/pages/index.php'); ?>
    ">&laquo; Back to list</a></div>

    <?php
    echo "ID is: " . h($id) . "<br />";
    echo "Content: " . h($page['content']) . "<br />";
    ?>
</div>

<?php include(SHARED_PATH . '/staff_footer.php');