<?php
/**
 * Class TiketRegular - Concrete Subclass
 * Merepresentasikan tiket untuk studio Regular bioskop
 * Extends abstract class Tiket
 */

class TiketRegular extends Tiket {
    /**
     * Properti tambahan untuk TiketRegular
     */
    
    // Tipe audio yang digunakan di studio Regular
    private $tipeAudio;
    
    // Lokasi baris kursi di studio Regular
    private $lokasiBaris;
    
    
    /**
     * Constructor
     * Menginisialisasi properti parent dan properti tambahan dari data database
     * 
     * @param int $id_tiket - ID tiket dari database
     * @param string $nama_film - Nama film dari database
     * @param string $jadwal_tayang - Jadwal tayang dari database
     * @param int $jumlah_kursi - Jumlah kursi dari database
     * @param float $hargaDasarTiket - Harga dasar tiket dari database
     * @param string $tipeAudio - Tipe audio dari database
     * @param string $lokasiBaris - Lokasi baris dari database
     */
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $tipeAudio, $lokasiBaris) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->tipeAudio = $tipeAudio;
        $this->lokasiBaris = $lokasiBaris;
    }
    
    
    /**
     * Getter untuk tipeAudio
     * @return string
     */
    public function getTipeAudio() {
        return $this->tipeAudio;
    }
    
    /**
     * Setter untuk tipeAudio
     * @param string $tipeAudio
     */
    public function setTipeAudio($tipeAudio) {
        $this->tipeAudio = $tipeAudio;
    }
    
    
    /**
     * Getter untuk lokasiBaris
     * @return string
     */
    public function getLokasiBaris() {
        return $this->lokasiBaris;
    }
    
    /**
     * Setter untuk lokasiBaris
     * @param string $lokasiBaris
     */
    public function setLokasiBaris($lokasiBaris) {
        $this->lokasiBaris = $lokasiBaris;
    }
    
    
    /**
     * Implementasi abstract method hitungTotalHarga()
     * Untuk TiketRegular, harga total = harga dasar + biaya tambahan untuk audio premium
     * 
     * @return float - Total harga tiket Regular
     */
    public function hitungTotalHarga() {
        $totalHarga = $this->hargaDasarTiket;
        
        // Tambahan biaya untuk audio premium (Dolby Digital)
        if ($this->tipeAudio === 'Dolby Digital') {
            $totalHarga += 5000; // Biaya tambahan untuk Dolby Digital
        }
        
        return $totalHarga;
    }
    
    
    /**
     * Implementasi abstract method tampilkanInfoFasilitas()
     * Menampilkan informasi fasilitas khusus studio Regular
     * 
     * @return void
     */
    public function tampilkanInfoFasilitas() {
        echo "===== FASILITAS TIKET REGULAR =====\n";
        echo "Film: " . $this->nama_film . "\n";
        echo "Jadwal Tayang: " . $this->jadwal_tayang . "\n";
        echo "Jumlah Kursi: " . $this->jumlah_kursi . "\n";
        echo "Lokasi Baris: " . $this->lokasiBaris . "\n";
        echo "Tipe Audio: " . $this->tipeAudio . "\n";
        echo "Harga Dasar: Rp " . number_format($this->hargaDasarTiket, 0, ',', '.') . "\n";
        echo "Total Harga: Rp " . number_format($this->hitungTotalHarga(), 0, ',', '.') . "\n";
        echo "=====================================\n";
    }
}
?>
