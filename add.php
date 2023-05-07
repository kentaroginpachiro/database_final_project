<?php
session_start();
require_once "koneksi.php";

if (!isset($_SESSION["id"])) {
    header("location: login.php");
}

if ($_SESSION["role"] != "admin") {
    header("location: index.php");
}

$error = "";
$nama = "";
$alamat = "";
$foto = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $foto = $_FILES["foto"]["name"];
    $tmp_name = $_FILES["foto"]["tmp_name"];

    $query = "INSERT INTO data (nama, alamat, foto) VALUES ('$nama', '$alamat', '$foto')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        move_uploaded_file($tmp_name, "uploads/" . $foto);
        header("location: index.php");
    } else {
        $error = "Terjadi kesalahan saat menambahkan data";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
</head>
<body>
    <h2>Tambah User</h2>
   <form method="post" enctype="multipart/form-data">
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?php echo $nama; ?>"><br>
    <br>
    <label>Alamat:</label><br>
    <textarea name="alamat"><?php echo $alamat; ?></textarea><br>
    <br>
    <label>Foto:</label><br>
    <input type="file" name="foto"><br>
    <br>
    <input type="submit" value="Tambahkan">
    <?php echo $error; ?>
</form>
</body>
</html>