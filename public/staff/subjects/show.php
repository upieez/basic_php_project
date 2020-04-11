<?php



$id = $_GET['id'] ?? '1'; // PHP > 7.0
$position = $_GET['position'] ?? '1'; // PHP > 7.0
$visible = isset($_GET['visible']) ? $_GET['id'] : '1'; // PHP < 7.0
$name = $_GET['name'] ?? 'GBI'; // PHP > 7.0

echo $id . "<br />";
echo $position . "<br />";
echo $visible . "<br />";
echo $name . "<br />";

?>