<?php
session_start();
require_once "koneksi.php";

if (!isset($_SESSION["id"])) {
    header("location: login.php");
}

if ($_SESSION["role"] != "2") {
    header("location: index.php");
}

$id = $_GET["id"];
$error = "";
$username = "";
$photos = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["username"];
    $alamat = $_POST["alamat"];
    $query = "UPDATE data SET username='$username', photo='$photos' WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("location: index.php");
    } else {
        $error = "Terjadi kesalahan saat mengedit data";
    }
} else {
    $query = "SELECT * FROM data WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row["username"];
        $photos = $row["photos"];
    } else {
        header("location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="post">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo $nama; ?>"><br>
        <br>
        <label>Alamat:</label><br>
        <textarea name="alamat"><?php echo $alamat; ?></textarea><br>
        <br>
        <input type="submit" value="Simpan">
        <?php echo $error; ?>
    </form>
</body>
</html>