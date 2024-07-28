
<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $sql = "SELECT * FROM users WHERE email = :email"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['roleid'] = $row['roleid'];
            if ($row['roleid'] == 1) {
                header("Location: admin.php");
            } else {
                header("Location: welcome.php");
            }
        } else {
            $_SESSION['error'] = "Invalid email or password";
            header("Location: login.php");
        }
    } catch(PDOException $e) {
        $_SESSION['error'] = "An error occurred. Please try again.";
        header("Location: login.php");
    }
    $pdo = null;
}
?>