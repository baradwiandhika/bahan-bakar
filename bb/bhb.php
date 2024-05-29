<?php
class DataBahanBakar {
    private $hargassuper;
    private $hargasvpower;
    private $hargasvpowerdiesel;
    private $hargasvpowernitro;
    public $jenisyangdipilih;
    public $totalliter;
    protected $totalpembayaran;

    public function setHarga($valssuper,$valsvpower,$valsvpowerdiesel,$valsvpowernitro) {
        $this->hargassuper = $valssuper;
        $this->hargasvpower = $valsvpower;
        $this->hargasvpowerdiesel = $valsvpowerdiesel;
        $this->hargasvpowernitro = $valsvpowernitro;
    }

    public function getHarga() {
        $semuaDatasolar["ssuper"] = $this->hargassuper; 
        $semuaDatasolar["svpower"] = $this->hargasvpower;
        $semuaDatasolar["svpowerdiesel"] = $this->hargasvpowerdiesel;
        $semuaDatasolar["svpowernitro"] = $this->hargasvpowernitro;

        return $semuaDatasolar;
    }


}

class pembelian extends DataBahanBakar {
    public function totalharga  () {
        $this->totalpembayaran = $this->getharga()[$this->jenisyangdipilih] * $this->totalliter;
    }
    public function cetakbukti(){
        echo "----------------------------------------------------------------";
        echo "<br>";
        echo "jenis bahan bakar : " . $this->jenisyangdipilih;
        echo "total liter : " . $this->totalliter;
        echo "total bayar : Rp. " . number_format($this->totalpembayaran, 0, ',', '.');
        echo "<br>";
        echo "----------------------------------------------------------------";
    }
}
?>