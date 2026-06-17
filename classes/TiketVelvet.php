<?php
/**
 * Class TiketVelvet - Concrete Subclass
 * Merepresentasikan tiket untuk studio Velvet (premium luxury) bioskop
 * Extends abstract class Tiket
 */

class TiketVelvet extends Tiket {
    /**
     * Properti tambahan untuk TiketVelvet
     */
    
    // Paket bantal dan selimut yang disediakan
    private $bantalSelimutPack;
    
    // Layanan butler premium yang tersedia
    private $layananButler;
    
    
    /**
     * Constructor
     * Menginisialisasi properti parent dan properti tambahan dari data database
     * 
     * @param int $id_tiket - ID tiket dari database
     * @param string $nama_film - Nama film dari database
     * @param string $jadwal_tayang - Jadwal tayang dari database
     * @param int $jumlah_kursi - Jumlah kursi dari database
     * @param float $hargaDasarTiket - Harga dasar tiket dari database
     * @param string $bantalSelimutPack - Paket bantal selimut dari database
     * @param string $layananButler - Layanan butler dari database
     */
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $bantalSelimutPack, $layananButler) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->bantalSelimutPack = $bantalSelimutPack;
        $this->layananButler = $layananButler;
    }
    
    
    /**
     * Getter untuk bantalSelimutPack
     * @return string
     */
    public function getBantalSelimutPack() {
        return $this->bantalSelimutPack;
    }
    
    /**
     * Setter untuk bantalSelimutPack
     * @param string $bantalSelimutPack
     */
    public function setBantalSelimutPack($bantalSelimutPack) {
        $this->bantalSelimutPack = $bantalSelimutPack;
    }
    
    
    /**
     * Getter untuk layananButler
     * @return string
     */
    public function getLayananButler() {
        return $this->layananButler;
    }
    
    /**
     * Setter untuk layananButler
     * @param string $layananButler
     */
    public function setLayananButler($layananButler) {
        $this->layananButler = $layananButler;
    }
    
    
    /**
     * Implementasi abstract method hitungTotalHarga()
     * Untuk TiketVelvet, dikenakan surcharge/biaya tambahan kelas premium sebesar 50%
     * Total Harga = (jumlah_kursi * hargaDasarTiket) * 1.50
     * 
     * @return float - Total harga tiket Velvet
     */
    public function hitungTotalHarga() {
        // Harga premium dengan surcharge 50% untuk kelas Velvet luxury
        $totalHarga = ($this->jumlah_kursi * $this->hargaDasarTiket) * 1.50;
        
        return $totalHarga;
    }
    
    
    /**
     * Implementasi abstract method tampilkanInfoFasilitas()
     * Menampilkan informasi fasilitas khusus studio Velvet (luxury)
     * 
     * @return void
     */
    public function tampilkanInfoFasilitas() {
        echo "===== FASILITAS TIKET VELVET (PREMIUM LUXURY) =====\n";
        echo "Film: " . $this->nama_film . "\n";
        echo "Jadwal Tayang: " . $this->jadwal_tayang . "\n";
        echo "Jumlah Kursi: " . $this->jumlah_kursi . " (Exclusive Sofa Lounge/Suite)\n";
        echo "Harga Per Tiket: Rp " . number_format($this->hargaDasarTiket, 0, ',', '.') . "\n";
        
        if (!is_null($this->bantalSelimutPack) && !empty($this->bantalSelimutPack)) {
            echo "Paket Bantal & Selimut: " . $this->bantalSelimutPack . "\n";
        }
        
        if (!is_null($this->layananButler) && !empty($this->layananButler)) {
            echo "Layanan Butler: " . $this->layananButler . "\n";
        }
        
        echo "Fasilitas Tambahan: Sofa Lounge Eksklusif, Snack Premium, Layanan VIP\n";
        echo "\nRumus Perhitungan:\n";
        echo "Total Harga = (Jumlah Kursi × Harga Dasar) × 1.50\n";
        echo "Total Harga = (" . $this->jumlah_kursi . " × Rp " . number_format($this->hargaDasarTiket, 0, ',', '.') . ") × 1.50\n";
        echo "\nTotal Harga: Rp " . number_format($this->hitungTotalHarga(), 0, ',', '.') . "\n";
        echo "(Surcharge Premium +50% untuk Kelas Velvet Luxury)\n";
        echo "====================================================\n";
    }
}
?>
