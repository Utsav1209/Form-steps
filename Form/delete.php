<?php
include("connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete_query = "UPDATE `userdata` SET delete_id = 0 WHERE id = $id";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Error deleting data']);
    }
} else {
    echo json_encode(['error' => 'ID not provided']);
}
