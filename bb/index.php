<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Bensin</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <form action="" method="post">
        <div style="display: flex;">
        <label for="liter">Masukan Jumlah Liter Pembelian : </label>
        <input type="text" name="liter" id="liter" required>   
    </div>
    <div style="display: flex;">
    <label for="jenis">Pilih Jenis Bahan Bakar</label   >
    <select name="jenis" required>
        <option value="ssuper">shell super</option>
        <option value="svpower">shell v-power</option>
        <option value="svpowerdiesel">shell v-power diesel</option>
        <option value="svpowernitro">shell v-power nitro</option>
    </select> 
    </div>
    <button type="submit" name="beli" required>Beli</button>
    </form>
    <?php
    require 'logic.php';
    $logic = new pembelian();
    $logic->setharga(10000, 15000, 18000, 20000);

    if(isset($_POST['beli'])) {
        $logic->jenisyangdipilih = $_POST['jenis'];
        $logic->totalliter = $_POST['liter'];
        $logic->totalharga();
        $logic->cetakbukti();
    }
    
    ?>

</body>
</html>