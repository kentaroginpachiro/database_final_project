<?php
session_start();
require_once "koneksi.php";

if (isset($_SESSION["id"])) {
    header("location: index.php");
}

$error = "";
$username = "";
$nama = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $error = "Username sudah terdaftar";
    } else {
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("location: login.php");
        } else {
            $error = "Terjadi kesalahan saat melakukan registrasi";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
</head>
<body>
    <h2>Registrasi</h2>
    <form method="post">
        <label>Username:</label><br>
        <input type="text" name="username" value="<?php echo $username; ?>"><br>
        <br>
        <label>Password:</label><br>
        <input type="password" name="password"><br>
        <br>
        <input type="submit" value="Daftar">
        <?php echo $error; ?>
    </form>
</body>
</html>