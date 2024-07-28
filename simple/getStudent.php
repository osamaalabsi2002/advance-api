<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

include 'connection.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$response = array();

if ($id > 0) {
    $sql = "SELECT * FROM simplee WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $response['status'] = 'success';
        $response['data'] = $result->fetch_assoc();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No record found for ID ' . $id;
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid ID provided';
}

echo json_encode($response);
$conn->close();
?>
