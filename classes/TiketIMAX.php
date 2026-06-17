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
     * Untuk TiketIMAX, harga total = harga dasar + biaya kacamata 3D + biaya efek gerak
     * 
     * @return float - Total harga tiket IMAX
     */
    public function hitungTotalHarga() {
        $totalHarga = $this->hargaDasarTiket;
        
        // Tambahan biaya untuk kacamata 3D (jika tersedia)
        if (!is_null($this->kacamata3dId) && !empty($this->kacamata3dId)) {
            $totalHarga += 15000; // Biaya tambahan untuk kacamata 3D
        }
        
        // Tambahan biaya untuk efek gerak (jika tersedia)
        if (!is_null($this->efekGerakFitur) && !empty($this->efekGerakFitur)) {
            $totalHarga += 10000; // Biaya tambahan untuk efek gerak
        }
        
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
        echo "Harga Dasar: Rp " . number_format($this->hargaDasarTiket, 0, ',', '.') . "\n";
        
        if (!is_null($this->kacamata3dId) && !empty($this->kacamata3dId)) {
            echo "Kacamata 3D: " . $this->kacamata3dId . " (+Rp 15.000)\n";
        } else {
            echo "Kacamata 3D: Tidak tersedia\n";
        }
        
        if (!is_null($this->efekGerakFitur) && !empty($this->efekGerakFitur)) {
            echo "Efek Gerak: " . $this->efekGerakFitur . " (+Rp 10.000)\n";
        } else {
            echo "Efek Gerak: Tidak tersedia\n";
        }
        
        echo "Total Harga: Rp " . number_format($this->hitungTotalHarga(), 0, ',', '.') . "\n";
        echo "=================================\n";
    }
}
?>
