<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type');

include 'connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$response = array();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id >0 && isset($data['name'], $data['age'], $data['grade'], $data['email'])) {
   
    $name = $data['name'];
    $age = $data['age'];
    $grade = $data['grade'];
    $email = $data['email'];

    $sql = "UPDATE simplee SET name = '$name', age = $age, grade = '$grade', email = '$email' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Student updated successfully';
        $response['id'] = $id;
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
