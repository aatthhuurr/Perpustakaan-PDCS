<?php
require_once "config.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4">
        <h1>Daftar Data Buku</h1>
        <a href="add_buku.php" class="btn btn-primary mb-3">Tambah Buku</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Tahun Terbit</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
                <tbody>
                    <?php 
                        $sql = "SELECT * FROM buku ORDER BY id_buku DESC";
                        $result = $mysqli->query($sql);
                        $no = 1;
                    ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <th scope="row"><?php echo $no ?></th>
                                <td><?php echo $row['judul'] ?></td>
                                <td><?php echo $row['penulis'] ?></td>
                                <td><?php echo $row['penerbit'] ?></td>
                                <td><?php echo $row['tahun_terbit'] ?></td>
                                <td><?php echo $row['stok'] ?></td>
                                <td>
                                    <a href="edit_buku.php?id=<?php echo $row['id_buku']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="hapus_buku.php?id=<?php echo $row['id_buku']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                            <?php $no++;endwhile; ?>
                            <?php $mysqli ->close(); ?>
                </tbody>
        </table>
    </div>
  </body>
</html>