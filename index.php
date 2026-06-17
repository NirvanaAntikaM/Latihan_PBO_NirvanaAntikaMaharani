<?php
/**
 * File: index.php
 * Antarmuka (View) untuk Menampilkan Daftar Tiket Penonton
 * Menampilkan tiket yang sudah dipesan secara dinamis dari database
 * Dikelompokkan berdasarkan jenis studio dengan menggunakan polymorphism
 */

// Memuat file konfigurasi database
require_once 'config/database.php';

// Memuat semua class tiket
require_once 'classes/Tiket.php';
require_once 'classes/TiketRegular.php';
require_once 'classes/TiketIMAX.php';
require_once 'classes/TiketVelvet.php';

// Inisialisasi database connection
$db = new Database();
$connection = $db->getConnection();

// Query untuk mengambil semua data tiket dari database
$query = "SELECT * FROM tabel_tiket ORDER BY jenis_studio, jadwal_tayang";
$tiketList = $db->query($query);

// Kelompokkan tiket berdasarkan jenis studio
$tiketRegular = [];
$tiketIMAX = [];
$tiketVelvet = [];

foreach ($tiketList as $row) {
    switch ($row['jenis_studio']) {
        case 'Regular':
            $tiketRegular[] = $row;
            break;
        case 'IMAX':
            $tiketIMAX[] = $row;
            break;
        case 'Velvet':
            $tiketVelvet[] = $row;
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tiket Penonton Bioskop - PBO OOP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            text-align: center;
            color: white;
            margin-bottom: 40px;
            padding: 20px;
        }
        
        header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .section {
            margin-bottom: 40px;
        }
        
        .section-title {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding: 15px 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .section-title h2 {
            font-size: 1.8rem;
            margin: 0;
            flex-grow: 1;
        }
        
        .section-badge {
            background: #667eea;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
        }
        
        .section-badge.regular {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        
        .section-badge.imax {
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }
        
        .section-badge.velvet {
            background: linear-gradient(135deg, #ffd89b, #19547b);
        }
        
        .tickets-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .ticket-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .ticket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
        
        .ticket-header {
            padding: 20px;
            border-bottom: 3px solid;
        }
        
        .ticket-header.regular {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-bottom-color: #667eea;
        }
        
        .ticket-header.imax {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            border-bottom-color: #f5576c;
        }
        
        .ticket-header.velvet {
            background: linear-gradient(135deg, #ffd89b, #19547b);
            border-bottom-color: #19547b;
        }
        
        .ticket-header h3 {
            color: white;
            font-size: 1.3rem;
            margin-bottom: 5px;
        }
        
        .ticket-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
        }
        
        .ticket-body {
            padding: 20px;
        }
        
        .ticket-info {
            margin-bottom: 15px;
        }
        
        .ticket-info label {
            display: block;
            font-weight: bold;
            color: #333;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
            opacity: 0.7;
        }
        
        .ticket-info value {
            display: block;
            font-size: 1rem;
            color: #333;
            padding: 8px 12px;
            background: #f5f5f5;
            border-radius: 5px;
            border-left: 3px solid #667eea;
        }
        
        .ticket-info value.imax {
            border-left-color: #f5576c;
        }
        
        .ticket-info value.velvet {
            border-left-color: #19547b;
        }
        
        .ticket-footer {
            padding: 20px;
            background: #f9f9f9;
            border-top: 2px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .harga-label {
            font-size: 0.85rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: bold;
        }
        
        .harga-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
        }
        
        .harga-value.imax {
            color: #f5576c;
        }
        
        .harga-value.velvet {
            color: #19547b;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: white;
            border-radius: 10px;
            color: #999;
        }
        
        .empty-state p {
            font-size: 1.1rem;
        }
        
        .calculation-box {
            background: #f0f0f0;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 12px;
            font-size: 0.85rem;
            color: #555;
            font-family: 'Courier New', monospace;
            line-height: 1.6;
        }
        
        .stats-summary {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-top: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }
        
        .stat-item {
            text-align: center;
            padding: 20px;
            background: #f5f5f5;
            border-radius: 8px;
            border-left: 5px solid;
        }
        
        .stat-item.regular {
            border-left-color: #667eea;
        }
        
        .stat-item.imax {
            border-left-color: #f5576c;
        }
        
        .stat-item.velvet {
            border-left-color: #19547b;
        }
        
        .stat-count {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }
        
        .stat-label {
            color: #666;
            margin-top: 8px;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header>
            <h1>🎬 SISTEM TIKET BIOSKOP</h1>
            <p>Demonstrasi Konsep OOP: Abstraksi, Pewarisan, dan Polimorfisme</p>
        </header>
        
        <!-- STUDIO REGULAR SECTION -->
        <section class="section">
            <div class="section-title">
                <h2>🎥 Studio Regular</h2>
                <span class="section-badge regular">Kelas Standar</span>
            </div>
            
            <?php if (!empty($tiketRegular)): ?>
                <div class="tickets-grid">
                    <?php foreach ($tiketRegular as $tiket): 
                        // Buat object TiketRegular dan tampilkan secara polimorfik
                        $tiketObj = new TiketRegular(
                            $tiket['id_tiket'],
                            $tiket['nama_film'],
                            $tiket['jadwal_tayang'],
                            $tiket['jumlah_kursi'],
                            $tiket['harga_dasar_tiket'],
                            $tiket['tipe_audio'],
                            $tiket['lokasi_baris']
                        );
                    ?>
                        <div class="ticket-card">
                            <div class="ticket-header regular">
                                <h3><?php echo htmlspecialchars($tiketObj->getNamaFilm()); ?></h3>
                                <p>Tiket ID: #<?php echo $tiketObj->getIdTiket(); ?></p>
                            </div>
                            
                            <div class="ticket-body">
                                <div class="ticket-info">
                                    <label>Jadwal Tayang</label>
                                    <value><?php echo htmlspecialchars($tiketObj->getJadwalTayang()); ?></value>
                                </div>
                                
                                <div class="ticket-info">
                                    <label>Jumlah Kursi</label>
                                    <value><?php echo $tiketObj->getJumlahKursi(); ?> Kursi</value>
                                </div>
                                
                                <div class="ticket-info">
                                    <label>Lokasi Baris</label>
                                    <value><?php echo htmlspecialchars($tiketObj->getLokasiBaris()); ?></value>
                                </div>
                                
                                <div class="ticket-info">
                                    <label>Tipe Audio</label>
                                    <value><?php echo htmlspecialchars($tiketObj->getTipeAudio()); ?></value>
                                </div>
                                
                                <div class="ticket-info">
                                    <label>Harga Per Tiket</label>
                                    <value>Rp <?php echo number_format($tiketObj->getHargaDasarTiket(), 0, ',', '.'); ?></value>
                                </div>
                                
                                <div class="calculation-box">
                                    <strong>Rumus Perhitungan:</strong><br>
                                    Total = Kursi × Harga<br>
                                    Total = <?php echo $tiketObj->getJumlahKursi(); ?> × Rp <?php echo number_format($tiketObj->getHargaDasarTiket(), 0, ',', '.'); ?>
                                </div>
                            </div>
                            
                            <div class="ticket-footer">
                                <div class="harga-label">Total Harga</div>
                                <div class="harga-value">Rp <?php echo number_format($tiketObj->hitungTotalHarga(), 0, ',', '.'); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p>Tidak ada tiket Regular yang dipesan</p>
                </div>
            <?php endif; ?>
        </section>
        
        <!-- STUDIO IMAX SECTION -->
        <section class="section">
            <div class="section-title">
                <h2>🍿 Studio IMAX</h2>
                <span class="section-badge imax">Teknologi Canggih</span>
            </div>
            
            <?php if (!empty($tiketIMAX)): ?>
                <div class="tickets-grid">
                    <?php foreach ($tiketIMAX as $tiket): 
                        // Buat object TiketIMAX dan tampilkan secara polimorfik
                        $tiketObj = new TiketIMAX(
                            $tiket['id_tiket'],
                            $tiket['nama_film'],
                            $tiket['jadwal_tayang'],
                            $tiket['jumlah_kursi'],
                            $tiket['harga_dasar_tiket'],
                            $tiket['kacamata_3d_id'],
                            $tiket['efek_gerak_fitur']
                        );
                    ?>
                        <div class="ticket-card">
                            <div class="ticket-header imax">
                                <h3><?php echo htmlspecialchars($tiketObj->getNamaFilm()); ?></h3>
                                <p>Tiket ID: #<?php echo $tiketObj->getIdTiket(); ?></p>
                            </div>
                            
                            <div class="ticket-body">
                                <div class="ticket-info">
                                    <label>Jadwal Tayang</label>
                                    <value><?php echo htmlspecialchars($tiketObj->getJadwalTayang()); ?></value>
                                </div>
                                
                                <div class="ticket-info">
                                    <label>Jumlah Kursi</label>
                                    <value><?php echo $tiketObj->getJumlahKursi(); ?> Kursi</value>
                                </div>
                                
                                <div class="ticket-info">
                                    <label>Harga Per Tiket</label>
                                    <value>Rp <?php echo number_format($tiketObj->getHargaDasarTiket(), 0, ',', '.'); ?></value>
                                </div>
                                
                                <?php if (!is_null($tiketObj->getKacamata3dId()) && !empty($tiketObj->getKacamata3dId())): ?>
                                    <div class="ticket-info">
                                        <label>Kacamata 3D</label>
                                        <value><?php echo htmlspecialchars($tiketObj->getKacamata3dId()); ?></value>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!is_null($tiketObj->getEfekGerakFitur()) && !empty($tiketObj->getEfekGerakFitur())): ?>
                                    <div class="ticket-info">
                                        <label>Efek Gerak</label>
                                        <value><?php echo htmlspecialchars($tiketObj->getEfekGerakFitur()); ?></value>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="calculation-box">
                                    <strong>Rumus Perhitungan:</strong><br>
                                    Total = (Kursi × Harga) + 35000<br>
                                    Total = (<?php echo $tiketObj->getJumlahKursi(); ?> × Rp <?php echo number_format($tiketObj->getHargaDasarTiket(), 0, ',', '.'); ?>) + Rp 35.000
                                </div>
                            </div>
                            
                            <div class="ticket-footer">
                                <div class="harga-label">Total Harga</div>
                                <div class="harga-value imax">Rp <?php echo number_format($tiketObj->hitungTotalHarga(), 0, ',', '.'); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p>Tidak ada tiket IMAX yang dipesan</p>
                </div>
            <?php endif; ?>
        </section>
        
        <!-- STUDIO VELVET SECTION -->
        <section class="section">
            <div class="section-title">
                <h2>👑 Studio Velvet</h2>
                <span class="section-badge velvet">Kelas Premium Luxury</span>
            </div>
            
            <?php if (!empty($tiketVelvet)): ?>
                <div class="tickets-grid">
                    <?php foreach ($tiketVelvet as $tiket): 
                        // Buat object TiketVelvet dan tampilkan secara polimorfik
                        $tiketObj = new TiketVelvet(
                            $tiket['id_tiket'],
                            $tiket['nama_film'],
                            $tiket['jadwal_tayang'],
                            $tiket['jumlah_kursi'],
                            $tiket['harga_dasar_tiket'],
                            $tiket['bantal_selimut_pack'],
                            $tiket['layanan_butler']
                        );
                    ?>
                        <div class="ticket-card">
                            <div class="ticket-header velvet">
                                <h3><?php echo htmlspecialchars($tiketObj->getNamaFilm()); ?></h3>
                                <p>Tiket ID: #<?php echo $tiketObj->getIdTiket(); ?></p>
                            </div>
                            
                            <div class="ticket-body">
                                <div class="ticket-info">
                                    <label>Jadwal Tayang</label>
                                    <value><?php echo htmlspecialchars($tiketObj->getJadwalTayang()); ?></value>
                                </div>
                                
                                <div class="ticket-info">
                                    <label>Jumlah Kursi</label>
                                    <value><?php echo $tiketObj->getJumlahKursi(); ?> Kursi (VIP)</value>
                                </div>
                                
                                <div class="ticket-info">
                                    <label>Harga Per Tiket</label>
                                    <value>Rp <?php echo number_format($tiketObj->getHargaDasarTiket(), 0, ',', '.'); ?></value>
                                </div>
                                
                                <?php if (!is_null($tiketObj->getBantalSelimutPack()) && !empty($tiketObj->getBantalSelimutPack())): ?>
                                    <div class="ticket-info">
                                        <label>Paket Bantal & Selimut</label>
                                        <value><?php echo htmlspecialchars($tiketObj->getBantalSelimutPack()); ?></value>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!is_null($tiketObj->getLayananButler()) && !empty($tiketObj->getLayananButler())): ?>
                                    <div class="ticket-info">
                                        <label>Layanan Butler</label>
                                        <value><?php echo htmlspecialchars($tiketObj->getLayananButler()); ?></value>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="calculation-box">
                                    <strong>Rumus Perhitungan:</strong><br>
                                    Total = (Kursi × Harga) × 1.50<br>
                                    Total = (<?php echo $tiketObj->getJumlahKursi(); ?> × Rp <?php echo number_format($tiketObj->getHargaDasarTiket(), 0, ',', '.'); ?>) × 1.50
                                </div>
                            </div>
                            
                            <div class="ticket-footer">
                                <div class="harga-label">Total Harga</div>
                                <div class="harga-value velvet">Rp <?php echo number_format($tiketObj->hitungTotalHarga(), 0, ',', '.'); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p>Tidak ada tiket Velvet yang dipesan</p>
                </div>
            <?php endif; ?>
        </section>
        
        <!-- SUMMARY STATISTICS -->
        <section class="stats-summary">
            <h2 style="color: #333; margin-bottom: 5px;">📊 Ringkasan Statistik Tiket</h2>
            <p style="color: #999; font-size: 0.95rem;">Data tiket yang telah dipesan dari database</p>
            
            <div class="stats-grid">
                <div class="stat-item regular">
                    <div class="stat-count"><?php echo count($tiketRegular); ?></div>
                    <div class="stat-label">Tiket Regular</div>
                </div>
                
                <div class="stat-item imax">
                    <div class="stat-count"><?php echo count($tiketIMAX); ?></div>
                    <div class="stat-label">Tiket IMAX</div>
                </div>
                
                <div class="stat-item velvet">
                    <div class="stat-count"><?php echo count($tiketVelvet); ?></div>
                    <div class="stat-label">Tiket Velvet</div>
                </div>
            </div>
        </section>
        
    </div>
</body>
</html>
