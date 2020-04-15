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

    <div class="page show">
    <h1>Page: <?php echo h($page['menu_name']); ?></h1>

    <div class="attributes">
        <dl>
            <dt>Menu Name</dt>
            <dd><?php echo h($page['menu_name']);?></dd>
        </dl>
        <dl>
            <dt>Subject</dt>
            <dd><?php echo h($page['subject_id']);?></dd>
        </dl>
        <dl>
            <dt>Position</dt>
            <dd><?php echo h($page['position']);?></dd>
        </dl>
        <dl>
            <dt>Visible</dt>
            <dd><?php echo h($page['visible']);?></dd>
        </dl>
        <dl>
            <dt>Content</dt>
            <dd><?php echo h($page['content']);?></dd>
        </dl>
    
    </div>
    
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php');