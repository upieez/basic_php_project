<?php 

require_once('../../../private/initialize.php'); 

$menu_name = '';
$position = '';
$visible = '';
$content = '';


if(is_post_request()){
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';
    $content = $_POST['content'] ?? '';
}
?>

<?php $page_title = 'Create Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Create Pages</h1>

    <form action="<?php echo url_for('/staff/pages/new.php')?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <option value="1"<?php if($position == "1") { echo " selected";} ?>>1</option>
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
          <textarea name="content" rows="5" column="20"></textarea>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Pages" />
      </div>
    </form>
    <div>
    <?php
    if(is_post_request()){
        echo "Form parameters<br />";
        echo "Menu name: " . $menu_name . "<br />";
        echo "Position: ". $position . "<br />";
        echo "Visible: " . $visible . "<br />";
        echo "Content: " . $content . "<br />";
    }
    ?>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
