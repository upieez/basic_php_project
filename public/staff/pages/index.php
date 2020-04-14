<?php include_once('../../../private/initialize.php'); ?>

<?php

    $pages_set = find_all_pages();

?>

<?php $page_title = 'Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="pages listing">
        <h1>Pages</h1>
    
        <div class="actions">
            <a class="action" href="<?php echo url_for('staff/pages/new.php'); ?>">Create New Pages</a>
        </div>

    <table class="list">
        <tr>
            <th>ID</th>
            <th>Subject ID</th>
            <th>Position</th>
            <th>Visible</th>
            <th>Title</th>
            <th>Content</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>

        <?php while($page = mysqli_fetch_assoc($pages_set)) { ?>
            <tr>
                <td><?php echo h($page['id']); ?></td>
                <td><?php echo $page['subject_id']; ?></td>
                <td><?php echo h($page['position']); ?></td>
                <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
                <td><?php echo h($page['menu_name']); ?></td>
                <td><?php echo h($page['content']); ?></td>
                <td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id'])) . '&content=' . h(u($page['content'])));?>">View</a></td>
                <td><a class="action" href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id']))); ?>">Edit</a></td>
                <td>Delete</td>
            </tr>
        <?php } ?>

    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>