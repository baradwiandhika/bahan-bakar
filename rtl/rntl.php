<?php
class Data {
    public $member;
    public $jenis;
    public $waktu;
    public $diskon;
    protected $pajak;
    private $Scoopy, $Beat, $Vario, $Aerox;
    private $listmember = ['Bara', 'irwan', 'samber', 'capung'];

    function __construct(){
        $this->pajak = 10000;
    }

    public function getMember(){
        if(in_array($this->member, $this->listmember)){
            return "member";
        }else{
            return "non-member";
        }
    }
    public function setHarga($jenis1, $jenis2, $jenis3, $jenis4){
        $this->Skupi = $jenis1;
        $this->Beat = $jenis2;
        $this->Vario = $jenis3;
        $this->Aerox = $jenis4;
    }
    public function getHarga() {
        $data["Scoopy"] = $this-> Scoopy;
        $data["Beat"] = $this-> Beat;
        $data["Vario"] = $this-> Vario;
        $data["Aerox"] = $this-> Aerox;
        return $data;
    }
}

class Rental extends Data {
    public function hargaRental () {
        $dataHarga = $this->getHarga()[$this->jenis];
        $diskon = $this->getMember() == "member" ? 5 : 0;
        if ($this->waktu === 1) {
            $bayar = ($dataHarga - ($dataHarga * $diskon / 100)) + $this->pajak;
        }else{
            $bayar = (($dataHarga * $this->waktu) - ($dataHarga * $diskon/100)) + $this->pajak;
        }
        return [$bayar, $diskon];
    }

public function pembayaran(){
    echo "<center>";
    echo  $this->member . "   adalah  " . $this->getMember() . " mendapatkan diskon sebesar    " . $this->hargaRental()[1] . "%";
    echo "<br />";
    echo "jenis motor yang di rental adalah " . $this->jenis . " selama ". $this->waktu. $this->waktu . " hari";
    echo "<br />";
    echo "harga rental perharinya : Rp. " . number_format( $this->getHarga()[$this->jenis], 0, '', '.');
    echo "<br />";
    echo "<br />";
    echo "besar yang harus di bayarkan adalah Rp. ". number_format($this->hargaRental()[0],0,'','.');
    echo "</center>";
    }

}






?>