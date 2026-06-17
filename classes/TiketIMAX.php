<?php
/**
 * Class TiketIMAX - Concrete Subclass
 * Merepresentasikan tiket untuk studio IMAX bioskop
 * Extends abstract class Tiket
 */

class TiketIMAX extends Tiket {
    /**
     * Properti tambahan untuk TiketIMAX
     */
    
    // ID kacamata 3D yang digunakan di studio IMAX
    private $kacamata3dId;
    
    // Fitur efek gerak/motion yang ditayangkan
    private $efekGerakFitur;
    
    
    /**
     * Constructor
     * Menginisialisasi properti parent dan properti tambahan dari data database
     * 
     * @param int $id_tiket - ID tiket dari database
     * @param string $nama_film - Nama film dari database
     * @param string $jadwal_tayang - Jadwal tayang dari database
     * @param int $jumlah_kursi - Jumlah kursi dari database
     * @param float $hargaDasarTiket - Harga dasar tiket dari database
     * @param string $kacamata3dId - ID kacamata 3D dari database
     * @param string $efekGerakFitur - Efek gerak fitur dari database
     */
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $kacamata3dId, $efekGerakFitur) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->kacamata3dId = $kacamata3dId;
        $this->efekGerakFitur = $efekGerakFitur;
    }
    
    
    /**
     * Getter untuk kacamata3dId
     * @return string
     */
    public function getKacamata3dId() {
        return $this->kacamata3dId;
    }
    
    /**
     * Setter untuk kacamata3dId
     * @param string $kacamata3dId
     */
    public function setKacamata3dId($kacamata3dId) {
        $this->kacamata3dId = $kacamata3dId;
    }
    
    
    /**
     * Getter untuk efekGerakFitur
     * @return string
     */
    public function getEfekGerakFitur() {
        return $this->efekGerakFitur;
    }
    
    /**
     * Setter untuk efekGerakFitur
     * @param string $efekGerakFitur
     */
    public function setEfekGerakFitur($efekGerakFitur) {
        $this->efekGerakFitur = $efekGerakFitur;
    }
    
    
    /**
     * Implementasi abstract method hitungTotalHarga()
     * Untuk TiketIMAX, dikenakan biaya tambahan teknologi proyeksi layar lebar IMAX dan audio flat
     * Total Harga = (jumlah_kursi * hargaDasarTiket) + 35000
     * 
     * @return float - Total harga tiket IMAX
     */
    public function hitungTotalHarga() {
        // Harga dasar total ditambah biaya tambahan teknologi IMAX Rp 35.000
        $totalHarga = ($this->jumlah_kursi * $this->hargaDasarTiket) + 35000;
        
        return $totalHarga;
    }
    
    
    /**
     * Implementasi abstract method tampilkanInfoFasilitas()
     * Menampilkan informasi fasilitas khusus studio IMAX
     * 
     * @return void
     */
    public function tampilkanInfoFasilitas() {
        echo "===== FASILITAS TIKET IMAX =====\n";
        echo "Film: " . $this->nama_film . "\n";
        echo "Jadwal Tayang: " . $this->jadwal_tayang . "\n";
        echo "Jumlah Kursi: " . $this->jumlah_kursi . "\n";
        echo "Harga Per Tiket: Rp " . number_format($this->hargaDasarTiket, 0, ',', '.') . "\n";
        
        if (!is_null($this->kacamata3dId) && !empty($this->kacamata3dId)) {
            echo "Kacamata 3D: " . $this->kacamata3dId . "\n";
        }
        
        if (!is_null($this->efekGerakFitur) && !empty($this->efekGerakFitur)) {
            echo "Efek Gerak: " . $this->efekGerakFitur . "\n";
        }
        
        echo "\nRumus Perhitungan:\n";
        echo "Total Harga = (Jumlah Kursi × Harga Dasar) + Biaya Teknologi IMAX\n";
        echo "Total Harga = (" . $this->jumlah_kursi . " × Rp " . number_format($this->hargaDasarTiket, 0, ',', '.') . ") + Rp 35.000\n";
        echo "\nTotal Harga: Rp " . number_format($this->hitungTotalHarga(), 0, ',', '.') . "\n";
        echo "(+Biaya Teknologi Proyeksi Layar Lebar IMAX & Audio Flat Rp 35.000)\n";
        echo "=================================\n";
    }
}
?>
