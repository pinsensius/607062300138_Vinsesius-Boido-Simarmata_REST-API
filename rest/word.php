<?php
require "config.php";

if (!isset($_GET['catid'])) {
    echo 'Error: Category ID (catid) required.';
    exit();
}

$result = mysqli_query($conn, "SELECT id, label, sunda, image FROM word WHERE cat_id=" . $_GET['catid']);

$dbdata = array();

while ($row = mysqli_fetch_assoc($result)) {
    $dbdata[]=$row;
}

echo json_encode($dbdata);
?>