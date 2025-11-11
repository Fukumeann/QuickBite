<?php
include 'connect.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO staffs (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        $message = "Staff registration successful! <a href='staffs_login.php'>Login here</a>";
    } else {
        $message = "Error: Email may already exist.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Staff Registration</title>
</head>

<body>
    <h2>Staff Registration</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Register</button>
    </form>
    <p><?php echo $message; ?></p>
</body>

</html>