<!DOCTYPE html>
<html>
<head>
    <title>CRUD User</title>
</head>
<body>
    <h1>Data User</h1>
    <a href="add.php">Tambah User</a>
    <br><br>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Role</th>
            <th>Photo</th>
            <th>Aksi</th>
        </tr>
        <?php
        session_start();
        require_once "koneksi.php";
        
        if (!isset($_SESSION["id"])) {
            header("location: login.php");
        }
        $id = $_GET["id"];
        
        include "koneksi.php";

        $query = "SELECT * FROM users ORDER BY id ASC";
        $action = "SELECT * FROM users where id = '$id'";
        $aksi = mysqli_query($coon, $action); // untuk edit hanya user itu saja
        $result = mysqli_query($conn, $query);
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $no = 1;
            while ($data = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data["username"]; ?></td>
                    <td><?php echo ucfirst($data["role"]); ?></td>
                    <td><?php echo $data["photo"]; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $data["id"]; ?>">Edit</a> | 
                        <a href="delete.php?id=<?php echo $data["id"]; ?>">Delete</a>
                    </td>
                </tr>
                <?php
                $no++;
            }
        } else {
            ?>
            <tr>
                <td colspan="6">Belum ada data user</td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>