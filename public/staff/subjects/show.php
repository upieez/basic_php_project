<?php require_once('../../../private/initialize.php'); ?>
<?php


$id = $_GET['id'] ?? '1'; // PHP > 7.0 Default value if it does not exists
$position = $_GET['position'] ?? '1'; // PHP > 7.0
$visible = isset($_GET['visible']) ? $_GET['id'] : '1'; // PHP < 7.0
$name = $_GET['name'] ?? 'GBI'; // PHP > 7.0

echo h($id) . "<br />";
echo h($position) . "<br />";
echo h($visible) . "<br />";
echo h($name) . "<br />";

?>

<a href="show.php?name=<?php echo u('John Doe'); ?>">Links</a><br />
<a href="show.php?name=<?php echo u('Widgets&More'); ?>">Links</a><br />
<a href="show.php?name=<?php echo u('!#*?'); ?>">Links</a><br />