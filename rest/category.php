<?php
require "config.php";

$result = mysqli_query($conn, "SELECT id, label, color FROM category");

$dbdata = array();

while ($row = mysqli_fetch_assoc($result)) {
    $dbdata[]=$row;
}

echo json_encode($dbdata);
?>