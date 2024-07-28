<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

include 'connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$response = array();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id >0) {
  
  

    $sql = "DELETE FROM simplee WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Student deleted successfully';
        $response['id'] =$id;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $conn->error;
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid input';
}

echo json_encode($response);

$conn->close();
?>
