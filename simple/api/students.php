<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

include '\xampp\htdocs\Demo\schoolManagement\connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$response = array();

if (isset($data['name'], $data['age'], $data['grade'], $data['email'])) {
    $name = $data['name'];
    $age = $data['age'];
    $grade = $data['grade'];
    $email = $data['email'];

    $sql = "INSERT INTO students (name, age, grade, email) VALUES ('$name', $age, '$grade', '$email')";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Student added successfully';
        $response['id'] = $conn->insert_id;
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
