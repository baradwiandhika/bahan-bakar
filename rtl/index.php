<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
      body {
            display: flex;
            justify-content: center;
            align-items: center;
      }
    </style>
    
</head>
<body>
<form action="" method="POST">
            <label for="jumlah">nama pelanggan :</label>
            <input type="text" id="nama" name="nama" min="0" step="1" required>
            <br> <br>
            <label for="jumlah">lama waktu rental :</label>
            <input type="number" id="waktu" name="waktu" min="0" step="1" required>
            <br> <br>
            <label  for="jenis"> Jenis motor:</label>
            <select id="jenis" name="jenis">
                <option value="Scoopy">Scoopy</option>
                <option value="Beat">Beat</option>
                <option value="Vario">Vario</option>
                <option value="Aerox">Aerox</option>
            </select>
            <button type="submit" name="submit">Beli</button>
        </form>
</body>
</html>
<?php
//memamnggil file
require "rntl.php";
//
$proses = new Rental();
$proses->setHarga(10000,15000,18000,20000);
//kalau ada
if (isset($_POST['submit'])){
    $proses->member = $_POST['nama'];
    $proses->waktu = $_POST['waktu'];
    $proses->jenis = $_POST['jenis'];
    $proses-> pembayaran();
}