<?php
session_start();
include 'conndb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM superuser WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($password== $row['password']) {
            $_SESSION['email'] = $email;
            $_SESSION['role_ID'] = $row['role_ID'];
            if ($row['role_ID'] == 2) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: admin.php");
                exit();
            } else {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: welcome.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid email or password";
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "An error occurred. Please try again.";
        header("Location: login.php");
        exit();
    }

}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
    <style> 
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            width: 50%;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        p {
            margin-bottom: 20px;
            color: #666;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        label {
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .login {
            background-color: #007bff;
        }

        .button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <p>Welcome back! Login with your credentials</p>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="button login">Login</button>
        </form>
        <p>Don't have an account? <a href="rigiter.php">Sign Up</a></p>
    </div>
</body>
</html>
