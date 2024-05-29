<?php
session_start();

// Hapus semua data siswa dari session
if (isset($_POST['clear'])) {
    unset($_SESSION['data_siswa']);
}

// Hapus data siswa tertentu dari session
if (isset($_POST['delete'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['data_siswa'][$index])) {
        unset($_SESSION['data_siswa'][$index]);
        $_SESSION['data_siswa'] = array_values($_SESSION['data_siswa']);
    }
}

// Simpan data siswa ke dalam session
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $nis = htmlspecialchars($_POST['nis']);
    $rayon = htmlspecialchars($_POST['rayon']);
    
    $data_siswa = [
        'nama' => $nama,
        'nis' => $nis,
        'rayon' => $rayon
    ];
    
    if (!isset($_SESSION['data_siswa'])) {
        $_SESSION['data_siswa'] = [];
    }
    $_SESSION['data_siswa'][] = $data_siswa;
}

// Mengambil data siswa yang akan diedit jika ada
$data_siswa_to_edit = null;
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['edit'])) {
    $index = $_GET['edit'];
    if (isset($_SESSION['data_siswa'][$index])) {
        $data_siswa_to_edit = $_SESSION['data_siswa'][$index];
    }
}

// Menyimpan perubahan pada data siswa yang diedit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_submit'])) {
    $index = $_POST['edit_index'];
    $nama = htmlspecialchars($_POST['nama']);
    $nis = htmlspecialchars($_POST['nis']);
    $rayon = htmlspecialchars($_POST['rayon']);
    
    if (isset($_SESSION['data_siswa'][$index])) {
        $_SESSION['data_siswa'][$index]['nama'] = $nama;
        $_SESSION['data_siswa'][$index]['nis'] = $nis;
        $_SESSION['data_siswa'][$index]['rayon'] = $rayon;
    }
}

$data_siswa_list = $_SESSION['data_siswa'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Output Data Siswa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: #f8f9fa;
        }
        .custom-container {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            background-color: #ffffff;
            margin-bottom: 20px;
        }
        .custom-container h2 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container custom-container col-sm-10 col-md-6">
        <h2 class="text-center mb-4">Masukkan Data Baru</h2>
        <form action="" method="post" class="col-12">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="nis">NIS:</label>
                <input type="text" class="form-control" id="nis" name="nis" required>
            </div>
            <div class="form-group">
                <label for="rayon">Rayon:</label>
                <input type="text" class="form-control" id="rayon" name="rayon" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mr-2" name="submit">Kirim</button>
                <button type="button" class="btn btn-success mr-2" onclick="window.print()">Cetak</button>
                <button type="button" class="btn btn-danger" onclick="hapusData()">Hapus Data</button>
            </div>
        </form>
    </div>

    <div class="container custom-container col-sm-10 col-md-8">
        <?php if (!empty($data_siswa_list)) : ?>
            <h2 class="text-center mb-4">Data Siswa</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Rayon</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_siswa_list as $index => $data) : ?>
                            <tr>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['nis']; ?></td>
                                <td><?php echo $data['rayon']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning" onclick="editData(<?php echo $index; ?>)">Edit</button>
                                        <form method="post" action="" class="ml-3">
                                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                                            <button type="submit" class="btn btn-danger" name="delete">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php if ($data_siswa_to_edit !== null && $index == $_GET['edit']) : ?>
                                <tr>
                                    <td colspan="4">
                                        <form action="" method="post">
                                            <input type="hidden" name="edit_index" value="<?php echo $index; ?>">
                                            <div class="form-group">
                                                <label for="edit_nama">Nama:</label>
                                                <input type="text" class="form-control" id="edit_nama" name="nama" value="<?php echo $data_siswa_to_edit['nama']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_nis">NIS:</label>
                                                <input type="text" class="form-control" id="edit_nis" name="nis" value="<?php echo $data_siswa_to_edit['nis']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_rayon">Rayon:</label>
                                                <input type="text" class="form-control" id="edit_rayon" name="rayon" value="<?php echo $data_siswa_to_edit['rayon']; ?>" required>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary" name="edit_submit">Simpan Perubahan</button>
                                                <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Batal</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                <form method="post" action="">
                    <button type="submit" class="btn btn-danger mt-3" name="clear">Hapus Semua Data</button>
                </form>
            </div>
        <?php else : ?>
            <div class="text-center">
                <p>Belum ada data siswa yang dimasukkan.</p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function hapusData() {
            document.getElementById("nama").value = "";
            document.getElementById("nis").value = "";
            document.getElementById("rayon").value = "";
        }

        function editData(index) {
            window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>?edit=" + index;
        }

        function cancelEdit() {
            window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>"; // Kembali ke halaman ini sendiri
        }
    </script>
</body>
</html>
