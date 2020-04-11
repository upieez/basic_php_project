<?php include_once('../../../private/initialize.php'); ?>

<?php
    $pages = [
        ['id' => '1', 'position' => '1' , 'visible' => '1', 'title' => 'About Globe Bank', 'content' => '`Deserunt minim nostrud sit excepteur ex esse consequat est sint non aute nostrud veniam.'],
        ['id' => '2', 'position' => '2' , 'visible' => '1', 'title' => 'Consumer', 'content' => 'Laborum duis ex commodo magna anim pariatur veniam cupidatat id cillum.'],
        ['id' => '3', 'position' => '3' , 'visible' => '1', 'title' => 'Small Business', 'content' => 'Culpa cillum exercitation qui nisi magna laborum veniam incididunt exercitation sint occaecat in magna.'],
        ['id' => '4', 'position' => '4' , 'visible' => '1', 'title' => 'Commercial', 'content' => 'Nostrud quis commodo velit nostrud quis.'],
    ];

?>

<?php $page_title = 'Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="pages listing">
        <h1>Pages</h1>
    
        <div class="actions">
            <a class="action" href="#">Create New Pages</a>
        </div>

    <table class="list">
        <tr>
            <th>ID</th>
            <th>Position</th>
            <th>Visible</th>
            <th>Title</th>
            <th>Content</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>

        <?php foreach($pages as $page) { ?>
            <tr>
                <td><?php echo h($page['id']); ?></td>
                <td><?php echo h($page['position']); ?></td>
                <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
                <td><?php echo h($page['title']); ?></td>
                <td><?php echo h($page['content']); ?></td>
                <td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id'])) . '&content=' . h(u($page['content'])));?>">View</a></td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        <?php } ?>

    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>