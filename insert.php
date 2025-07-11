<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "prog_task2";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = isset($_POST['name']) ? trim($_POST['name']) : '';
    $age   = isset($_POST['age']) ? (int)$_POST['age'] : 0;
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    if ($name && $age > 0 && $phone && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("INSERT INTO users (name, age, phone, email) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("siss", $name, $age, $phone, $email);
            if ($stmt->execute()) {
                header("Location: index.php?success=1");
                exit();
            } else {
                echo "Error saving data.";
            }
            $stmt->close();
        } else {
            echo "Error in statement.";
        }
    } else {
        echo "Please fill all fields correctly.";
    }
}

$conn->close();
?>