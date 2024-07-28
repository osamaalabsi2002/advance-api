<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include 'connection.php';

$sql = "SELECT * FROM simplee";
$result = $conn->query($sql);

$response = array();
$students = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
    $response['status'] = 'success';
    $response['data'] = $students;
} else {
    $response['status'] = 'error';
    $response['message'] = 'No records found';
}

echo json_encode($response);

$conn->close();
?>