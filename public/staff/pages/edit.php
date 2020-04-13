<?php 

require_once('../../../private/initialize.php'); 

if(!isset($_GET['id'])){
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];
$menu_name = '';
$position = '';
$visible = '';
$content = '';

if(is_post_request()){
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = ($_POST['visible'] == 1 ) ? 'visible' : 'not visible';
    $content = $_POST['content'] ?? '';

}
?>

<?php $page_title = 'Edit Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Edit Pages</h1>

    <form action="<?php echo url_for('/staff/pages/edit.php?id=' . $id)?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo $menu_name ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <option value="1">1</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" />
        </dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="content" rows="5" column="20"><?php echo $content; ?></textarea>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Subject" />
      </div>
    </form>

    <div>
    <?php

    if(is_post_request()){
        echo "Edit Form details<br />";
        echo "Menu Name: " . $menu_name . "<br />";
        echo "Position: " . $position . "<br />";
        echo "Visible: ". $visible . "<br />";
        echo "Content: ". $content . "<br />";
    }

    ?>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
