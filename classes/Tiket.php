<?php
/**
 * Abstract Class Tiket
 * Kelas abstrak yang mendefinisikan struktur umum untuk berbagai jenis tiket bioskop
 */

abstract class Tiket {
    /**
     * Properti Terenkapsulasi (Protected)
     * Hanya dapat diakses oleh class ini dan class turunannya
     */
    
    // ID unik untuk tiket
    protected $id_tiket;
    
    // Nama film yang ditayangkan
    protected $nama_film;
    
    // Jadwal tayang (tanggal dan waktu pertunjukan)
    protected $jadwal_tayang;
    
    // Jumlah kursi yang tersedia
    protected $jumlah_kursi;
    
    // Harga dasar tiket sebelum penambahan fasilitas
    protected $hargaDasarTiket;
    
    
    /**
     * Constructor
     * Menginisialisasi properti dari data yang diterima dari database
     * 
     * @param int $id_tiket - ID tiket dari database
     * @param string $nama_film - Nama film dari database
     * @param string $jadwal_tayang - Jadwal tayang dari database
     * @param int $jumlah_kursi - Jumlah kursi dari database
     * @param float $hargaDasarTiket - Harga dasar tiket dari database
     */
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket) {
        $this->id_tiket = $id_tiket;
        $this->nama_film = $nama_film;
        $this->jadwal_tayang = $jadwal_tayang;
        $this->jumlah_kursi = $jumlah_kursi;
        $this->hargaDasarTiket = $hargaDasarTiket;
    }
    
    
    /**
     * Getter untuk id_tiket
     * @return int
     */
    public function getIdTiket() {
        return $this->id_tiket;
    }
    
    /**
     * Setter untuk id_tiket
     * @param int $id_tiket
     */
    public function setIdTiket($id_tiket) {
        $this->id_tiket = $id_tiket;
    }
    
    
    /**
     * Getter untuk nama_film
     * @return string
     */
    public function getNamaFilm() {
        return $this->nama_film;
    }
    
    /**
     * Setter untuk nama_film
     * @param string $nama_film
     */
    public function setNamaFilm($nama_film) {
        $this->nama_film = $nama_film;
    }
    
    
    /**
     * Getter untuk jadwal_tayang
     * @return string
     */
    public function getJadwalTayang() {
        return $this->jadwal_tayang;
    }
    
    /**
     * Setter untuk jadwal_tayang
     * @param string $jadwal_tayang
     */
    public function setJadwalTayang($jadwal_tayang) {
        $this->jadwal_tayang = $jadwal_tayang;
    }
    
    
    /**
     * Getter untuk jumlah_kursi
     * @return int
     */
    public function getJumlahKursi() {
        return $this->jumlah_kursi;
    }
    
    /**
     * Setter untuk jumlah_kursi
     * @param int $jumlah_kursi
     */
    public function setJumlahKursi($jumlah_kursi) {
        $this->jumlah_kursi = $jumlah_kursi;
    }
    
    
    /**
     * Getter untuk hargaDasarTiket
     * @return float
     */
    public function getHargaDasarTiket() {
        return $this->hargaDasarTiket;
    }
    
    /**
     * Setter untuk hargaDasarTiket
     * @param float $hargaDasarTiket
     */
    public function setHargaDasarTiket($hargaDasarTiket) {
        $this->hargaDasarTiket = $hargaDasarTiket;
    }
    
    
    /**
     * ABSTRACT METHOD - Wajib diimplementasikan oleh class turunan
     * 
     * Method untuk menghitung total harga tiket termasuk semua fasilitas tambahan
     * Setiap jenis tiket (Regular, IMAX, Velvet) akan memiliki perhitungan yang berbeda
     * 
     * @return float - Total harga tiket
     */
    abstract public function hitungTotalHarga();
    
    
    /**
     * ABSTRACT METHOD - Wajib diimplementasikan oleh class turunan
     * 
     * Method untuk menampilkan informasi fasilitas khusus dari tiket
     * Setiap jenis tiket memiliki fasilitas yang berbeda
     * 
     * @return void
     */
    abstract public function tampilkanInfoFasilitas();
}
?>
