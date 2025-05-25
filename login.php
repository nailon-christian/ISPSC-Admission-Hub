<?php
session_start();
if (isset($_SESSION['username'])) {
    // Redirect logged-in users to dashboard
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<form method="POST" action="login_process.php">
  Username: <input type="text" name="username" required /><br />
  Password: <input type="password" name="password" required /><br />
  <button type="submit">Login</button>
</form>
<?php
if (isset($_GET['error'])) {
    echo "<p style='color:red;'>".$_GET['error']."</p>";
}
?>
</body>
</html>
