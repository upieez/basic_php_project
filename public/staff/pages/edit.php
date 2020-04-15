<?php 

require_once('../../../private/initialize.php'); 

if(!isset($_GET['id'])){
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];

if(is_post_request()){

    $page = [];
    $page['id'] = $id;
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    $result = update_page($page);
    if($result === true){
      redirect_to(url_for('/staff/pages/show.php?id=' . $id));
    } else {
      $errors = $result;
    }

} else {

  $page = find_page_by_id($id);

}

$page_set = find_all_pages();
$page_count = mysqli_num_rows($page_set);
mysqli_free_result($page_set);

?>

<?php $page_title = 'Edit Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Edit Pages</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/pages/edit.php?id=' . $id)?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>" /></dd>
      </dl>
      <dl>
      <dl>
        <dt>Subject</dt>
        <dd>
        <select name="subject_id">
        <?php
          $subject_set = find_all_subjects();
          while($subject = mysqli_fetch_assoc($subject_set)){
            echo "<option value=\"" . h($subject['id']) . "\"";
            if($page["subject_id"] == $subject['id']){
              echo " selected";
            }
            echo ">" . h($subject['menu_name']) . "</option>";
          }
          mysqli_free_result($subject_set);
        ?>
        </select>
        </dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
              for($i=0;$i<=$page_count;$i++){
                echo "<option value=\"{$i}\"";
                if($page["position"] == $i){
                  echo " selected";
              }
              echo ">{$i}</option>";
            }
            ?>
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
          <textarea name="content" rows="5" column="20"><?php echo $page['content']; ?></textarea>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Subject" />
      </div>
    </form>

    <div>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
