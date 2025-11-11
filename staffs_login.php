<?php
session_start();
include 'connect.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM staffs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin["password"])) {
        $_SESSION["admin_id"] = $admin["id"];
        $_SESSION["admin_name"] = $admin["name"];
        header("Location: staffs_dashboard.php");
        exit();
    } else {
        $message = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
</head>

<body>
    <h2>Admin Login</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <p><?php echo $message; ?></p>
</body>

</html>