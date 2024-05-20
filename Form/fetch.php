<?php
include("connect.php");

$sql = "SELECT * FROM `userdata` WHERE delete_id = 1";
$result = mysqli_query($conn, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
