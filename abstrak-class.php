<?php  

// JUALAN PRODUK
// 1. KOMIK
// 2. GAME

use Produk as GlobalProduk;

abstract class Produk {
    private  $judul, 
             $penulis,
             $penerbit,
             $harga,
             $diskon = 0;


    public function __construct( $judul = "Judul", $penulis = "Penulis", $penerbit = "Penerbit", $harga = 0)
    {
     $this->judul = $judul;
     $this->penulis = $penulis;
     $this->penerbit = $penerbit;
     $this->harga = $harga;
    }

    public function setJudul( $judul ) {
        $this->judul = $judul;
    }

    public function getJudul() {
        return $this->judul;
    }

    public function setPenulis( $penulis ) {
        $this->penulis = $penulis;
    }

    public function getPenulis() {
        return $this->penulis;
    }

    public function setPenerbit( $penerbit ) {
        $this->penerbit = $penerbit;
    }

    public function getPenerbit() {
        return $this->penerbit;
    }

    public function setDiskon( $diskon ) {
        $this->diskon = $diskon;
    }

    public function getDiskon() {
        return $this->diskon;
    }

    public function setHarga( $harga ) {
        $this->harga = $harga;
    }

    public function getHarga() {
        return $this->harga - ( $this->harga * $this->diskon / 100 );
    }

    public function getLabel() {
        return "$this->penulis, $this->penerbit";
    }

    abstract public function getInfoProduk();
    public function getInfo(){
     $str = "{$this->judul} | {$this->getLabel()} (Rp. {$this->harga})";

     return $str;
    }
}

class Komik extends produk {
    public $jmHalaman;

    public function __construct( $judul = "Judul", $penulis = "Penulis", $penerbit = "Penerbit", $harga = 0, $jmHalaman = 0 )
    {
        parent::__construct( $judul, $penulis, $penerbit, $harga );

        $this->jmHalaman = $jmHalaman;
    }
    
    public function getInfoProduk() {
     $str = "Komik : " . $this->getInfo() . " - {$this->jmHalaman} Halaman.";
    return $str;
    }
}

class Game extends Produk {
    public $waktuMain;

    public function __construct( $judul = "Judul", $penulis = "Penulis", $penerbit = "Penerbit", $harga = 0, $waktuMain = 0 )
    {
        parent::__construct( $judul, $penulis, $penerbit, $harga);

        $this->waktuMain = $waktuMain;
    }

    public function getInfoProduk() {
        $str = "Game : " . $this->getInfo() . " ~ {$this->waktuMain} Jam.";
       return $str;
       }
}

class CetakInfoProduk {
    public $daftarProduk = array();

    public function tambahProduk( Produk $produk ) {
        $this->daftarProduk[] = $produk;
    }

    public function cetak() {
        $str = "DAFTAR PRODUK : <br>";

        foreach( $this->daftarProduk as $p) {
            $str .= "- {$p->getInfoProduk()} <br>";
        }

        return $str;
    }
}

$produk1 = new komik("Naruto", "Masashi Kishimoto", "Shonen Jump", 3000, 100);
$produk2 = new Game("Unsharted", "Neil Druckman", "Sony Computer", 25000, 50);


$cetakProduk = new CetakInfoProduk();
$cetakProduk->tambahProduk( $produk1 );
$cetakProduk->tambahProduk( $produk2 );

echo $cetakProduk->cetak();

























?>