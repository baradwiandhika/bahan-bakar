<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Pembelian Bahan Bakar</title>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f0f0f0;
        text-align: center;
        background-image:url(https://traction.gr/wp-content/uploads/2019/01/shell.jpg);
        background-size: cover;  
    }

    .container {
        width: 70%;
        margin: auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-image:url(https://traction.gr/wp-content/uploads/2019/01/shell.jpg);
        background-size: cover;  
        color: white;
    }
        
        
    }

    h1 {
        margin-bottom: 50px;
        color: orange;
    }

    h2 {
        margin-bottom: 20px;
    }

    h4 {
        margin-bottom: 10px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    select, input[type="number"], button {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }

    button {
        width: 70px;
        
        
        border: none;
        cursor: pointer;
    }

    .detail-pembelian {
        margin-top: 20px;
        border-top: 1px solid #ccc;
        padding-top: 10px;
    }

    .form-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        <img src="http://www.dsf.my/wp-content/uploads/2016/07/shell-v-power1.jpg" alt="">  
        
    }

    .form-group label {
        width: 30%;
        text-align: right;
    }

    .form-group select, 
    .form-group input[type="number"] {
        width: 65%;
    }
</style>
</head>
<body>
<div class="container">
    <?php
    class Shell {
    public $harga_super;
    public $harga_vpower;
    public $harga_diesel;
    public $harga_nitro;
    public $ppn;

    public function __construct($harga_super, $harga_vpower, $harga_diesel, $harga_nitro, $ppn) {
        $this->harga_super = $harga_super;
        $this->harga_vpower = $harga_vpower;
        $this->harga_diesel = $harga_diesel;
        $this->harga_nitro = $harga_nitro;
        $this->ppn = $ppn;
    }
}

class Beli extends Shell {
    public function hitungTotalBayar($jenis, $jumlah) {
        switch ($jenis) {
            case "Super":
                $harga_per_liter = $this->harga_super;
                break;
            case "V-Power":
                $harga_per_liter = $this->harga_vpower;
                break;
            case "Diesel":
                $harga_per_liter = $this->harga_diesel;
                break;
            case "V-Power Nitro":
                $harga_per_liter = $this->harga_nitro;
                break;
            default:
                return "Jenis bahan bakar tidak valid";
        }

        $total = $harga_per_liter * $jumlah;
        $total += $total * ($this->ppn / 100);   
        return number_format($total, 2, ",", ".");  
    }
}
 

$harga = [
    "Super" => 15420,
    "V-Power" => 16130,
    "V-Power Diesel" => 18310,
    "V-Power Nitro" => 16510
];
$ppn = 10;  

 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["jenis"]) && isset($_POST["jumlah"])) {
    $jenis = $_POST["jenis"];
    $jumlah = $_POST["jumlah"];

    
    $shell = new Beli($harga["Super"], $harga["V-Power"], $harga["V-Power Diesel"], $harga["V-Power Nitro"], $ppn);

    if (array_key_exists($jenis, $harga)) {
        $total_bayar = $shell->hitungTotalBayar($jenis, $jumlah);
        echo "<h2>Detail Pembelian</h2>";
        echo "-----------------------------------------------------------------------------------";
        echo "<h4>Anda membeli bahan bakar minyak tipe: $jenis</h4>";
        echo "<h4>Dengan jumlah liter: $jumlah</h4>";
        echo "<h4>Total yang harus anda bayar: Rp. $total_bayar</h4>";
        echo "----------------------------------------------------------------------------------";
    } else {

    }
}
?>

<h2>Form Pembelian Bahan Bakar</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <div class="form-group">
        <label for="jenis">Pilih Jenis Bahan Bakar:</label>
        <select id="jenis" name="jenis">
            <option value="Super">Shell Super</option>
            <option value="V-Power">Shell V-Power</option>
            <option value="V-Power Diesel">Shell V-Power Diesel</option>
            <option value="V-Power Nitro">Shell V-Power Nitro</option>
        </select>
    </div>

    <div class="form-group">
        <label for="jumlah">Jumlah Liter:</label>
        <input type="number" id="jumlah" name="jumlah" min="1" required>
    </div>

    <button type="submit">Submit</button>
</form>
</div>

</body>
</html>
