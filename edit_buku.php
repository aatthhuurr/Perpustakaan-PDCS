<?php
require_once 'config.php';

// Proses Update data
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_buku = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];

    $sql = "UPDATE buku 
            SET judul = ?, penulis = ?, penerbit = ?, tahun_terbit = ?, stok = ?
            WHERE id_buku = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sssiii", $judul, $penulis, $penerbit, $tahun_terbit, $stok, $id_buku);

        if ($stmt->execute()) {
            header("Location: buku.php?pesan=update_sukses");
            exit();
        } else {
            echo "Terjadi kesalahan saat memperbarui data.";
        }
        $stmt->close();
    } else {
        echo "Gagal menyiapkan statement SQL.";
    }
}

// Ambil data buku yang akan diedit
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM buku WHERE id_buku = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $buku = $result->fetch_assoc(); 
            } else {
                echo "Data tidak ditemukan.";
                exit();
            }
        } else {
            echo "Error.";
            exit();
        }
        $stmt->close();
    }
} else {
    header('Location: buku.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

    <div class="container mt-4">
        <h2>Edit Buku</h2>
        <form action="" method="post">

            <input type="hidden" name="id_buku" value="<?php echo $buku['id_buku']; ?>">

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $buku['judul']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" value="<?php echo $buku['penulis']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $buku['penerbit']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?php echo $buku['tahun_terbit']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $buku['stok']; ?>" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="buku.php" class="btn btn-secondary">Batal</a>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

<?php
$mysqli->close();
?>
