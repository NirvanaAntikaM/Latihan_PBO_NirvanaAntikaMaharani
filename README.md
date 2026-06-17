# 🎬 Sistem Tiket Bioskop - Demonstrasi OOP PHP

## Deskripsi Proyek
Proyek ini adalah implementasi konsep Object-Oriented Programming (OOP) dalam PHP dengan fokus pada:
- **Abstraksi (Abstraction)** - Abstract class Tiket
- **Pewarisan (Inheritance)** - TiketRegular, TiketIMAX, TiketVelvet
- **Polimorfisme (Polymorphism)** - Method overriding hitungTotalHarga()

Aplikasi ini menampilkan sistem tiket bioskop yang dinamis dengan tiga jenis studio berbeda.

---

## Struktur Folder Proyek

```
Tugas simulasi UAS/
├── config/
│   └── database.php          # Konfigurasi dan koneksi database
├── classes/
│   ├── Tiket.php            # Abstract class utama
│   ├── TiketRegular.php     # Concrete class untuk studio Regular
│   ├── TiketIMAX.php        # Concrete class untuk studio IMAX
│   └── TiketVelvet.php      # Concrete class untuk studio Velvet
├── Databases/
│   └── db_latihan_pbo_trpl1b_nirvanaantikamaharani.sql  # Database SQL
├── index.php                 # View utama - Halaman web
└── README.md                 # File ini
```

---

## Persyaratan Sistem

- **PHP** 7.4 atau lebih tinggi
- **MySQL/MariaDB** dengan PDO extension
- **Web Server** (Apache, Nginx, atau PHP Built-in Server)
- Browser web modern

---

## Instalasi & Konfigurasi

### 1. Setup Database

Buka phpMyAdmin atau MySQL Client dan jalankan script SQL:

```bash
mysql -u root -p < Databases/db_latihan_pbo_trpl1b_nirvanaantikamaharani.sql
```

Atau import file SQL melalui phpMyAdmin.

**Database Name:** `db_latihan_pbo_trpl1b_nirvanaantikamaharani`

### 2. Konfigurasi Koneksi Database

Edit file `config/database.php` dan sesuaikan dengan pengaturan MySQL Anda:

```php
private $host = 'localhost';
private $port = 3306;
private $db_name = 'db_latihan_pbo_trpl1b_nirvanaantikamaharani';
private $username = 'root';      // Sesuaikan username
private $password = '';          // Sesuaikan password jika ada
```

### 3. Menjalankan Aplikasi

**Opsi A - Menggunakan PHP Built-in Server:**

```bash
cd "c:\Users\nirva\OneDrive\Documents\smt 2\PBO\Tugas simulasi UAS"
php -S localhost:8000
```

Akses di browser: `http://localhost:8000`

**Opsi B - Menggunakan Web Server (Apache/Nginx):**

Copy folder proyek ke direktori `htdocs` (Apache) atau `www` (Nginx), lalu akses melalui URL yang sesuai.

---

## Fitur Utama Aplikasi

### 1. **Studio Regular** 🎥
- Tarif standar tanpa biaya tambahan
- Properti: tipeAudio, lokasiBaris
- **Rumus Harga:** Total = Jumlah_Kursi × Harga_Dasar

### 2. **Studio IMAX** 🍿
- Teknologi proyeksi layar lebar dengan biaya tambahan
- Properti: kacamata3dId, efekGerakFitur
- **Rumus Harga:** Total = (Jumlah_Kursi × Harga_Dasar) + 35000

### 3. **Studio Velvet** 👑
- Kelas premium luxury dengan surcharge
- Properti: bantalSelimutPack, layananButler
- **Rumus Harga:** Total = (Jumlah_Kursi × Harga_Dasar) × 1.50

---

## Konsep OOP yang Diimplementasikan

### ✅ Abstraksi (Abstraction)
```php
abstract class Tiket {
    protected $id_tiket;
    protected $nama_film;
    protected $jadwal_tayang;
    protected $jumlah_kursi;
    protected $hargaDasarTiket;
    
    abstract public function hitungTotalHarga();
    abstract public function tampilkanInfoFasilitas();
}
```

### ✅ Pewarisan (Inheritance)
```php
class TiketRegular extends Tiket { ... }
class TiketIMAX extends Tiket { ... }
class TiketVelvet extends Tiket { ... }
```

### ✅ Polimorfisme (Polymorphism - Method Overriding)
```php
// Setiap subclass mengimplementasikan hitungTotalHarga() berbeda
class TiketRegular {
    public function hitungTotalHarga() {
        return $this->jumlah_kursi * $this->hargaDasarTiket;
    }
}

class TiketIMAX {
    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) + 35000;
    }
}

class TiketVelvet {
    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) * 1.50;
    }
}
```

### ✅ Enkapsulasi (Encapsulation)
- Properti protected untuk aksesibilitas internal dan turunan
- Getter dan Setter untuk kontrol akses

---

## Data Contoh dari Database

### Studio Regular
| ID | Film | Jadwal | Kursi | Harga | Audio | Lokasi |
|----|------|--------|-------|-------|-------|--------|
| 1 | Mean Girls | 2026-06-20 13:00 | 50 | 40000 | Dolby Digital | Row A |

**Perhitungan:** 50 × 40000 = **Rp 2.000.000**

### Studio IMAX
| ID | Film | Jadwal | Kursi | Harga | 3D | Efek |
|----|------|--------|-------|-------|-----|------|
| 8 | Moana | 2026-06-20 14:00 | 100 | 75000 | GLASSES-3D-M1 | Water Splash FX |

**Perhitungan:** (100 × 75000) + 35000 = **Rp 7.535.000**

### Studio Velvet
| ID | Film | Jadwal | Kursi | Harga | Bantal | Butler |
|----|------|--------|-------|-------|--------|---------|
| 15 | Gossip Girl | 2026-06-20 20:00 | 20 | 150000 | Pink Silk Blanket | Macarons & Tea |

**Perhitungan:** (20 × 150000) × 1.50 = **Rp 4.500.000**

---

## Fitur View/Antarmuka

### Halaman Utama (index.php)
✅ **Menampilkan:**
- Header dengan judul dan deskripsi
- 3 Section terpisah untuk setiap jenis studio
- Kartu tiket (ticket card) untuk setiap pesanan
- Rumus perhitungan harga yang terlihat jelas
- Total harga yang dihitung secara polimorfik
- Ringkasan statistik tiket di bagian bawah

✅ **Design:**
- Responsive grid layout (Mobile-friendly)
- Gradient colors untuk setiap jenis studio
- Interactive hover effects
- Modern card-based design
- Color-coded badges dan indicators

---

## Alur Kerja Aplikasi

```
1. index.php memuat database.php
2. Membuat object Database dan query ke tabel_tiket
3. Grouping tiket berdasarkan jenis_studio
4. Untuk setiap tiket:
   a. Buat object (TiketRegular/TiketIMAX/TiketVelvet)
   b. Call method getters untuk display data
   c. Call method hitungTotalHarga() secara polimorfik
   d. Render card dengan HTML & CSS
5. Display statistik ringkasan
```

---

## Troubleshooting

### ❌ Error: "Database Connection Error"
- Pastikan MySQL server running
- Verifikasi username dan password di `config/database.php`
- Pastikan database sudah diimport dari file SQL

### ❌ Error: "Class not found"
- Pastikan semua file class sudah ada di folder `classes/`
- Verify require_once path di index.php

### ❌ Tidak ada data yang tampil
- Pastikan data sudah diinsert ke database
- Check database name dan tabel name (`tabel_tiket`)
- Buka phpMyAdmin dan verifikasi data

---

## File-File Penting

| File | Deskripsi |
|------|-----------|
| `index.php` | Halaman utama view dengan CSS inline |
| `config/database.php` | Class Database untuk koneksi PDO |
| `classes/Tiket.php` | Abstract class parent |
| `classes/TiketRegular.php` | Subclass untuk studio Regular |
| `classes/TiketIMAX.php` | Subclass untuk studio IMAX |
| `classes/TiketVelvet.php` | Subclass untuk studio Velvet |
| `Databases/db_*.sql` | Script pembuatan database |

---

## Tahap-Tahap Pengembangan

- ✅ **Tahap 1:** Pembuatan Database & Tabel
- ✅ **Tahap 2:** Entity-Relationship Diagram (ERD)
- ✅ **Tahap 3:** Implementasi Abstraksi
- ✅ **Tahap 4:** Implementasi Pewarisan
- ✅ **Tahap 5:** Implementasi Polimorfisme
- ✅ **Tahap 6:** Pembuatan Komponen View (Sekarang)

---

## Pengembangan Lebih Lanjut

Fitur yang dapat ditambahkan:
- 🔍 Search & Filter tiket
- 🛒 Shopping cart functionality
- 💳 Payment gateway integration
- 📊 Dashboard admin
- 📱 Mobile app version
- 🔐 User authentication system
- 📧 Email notification

---

## Author
**Nirvana Antika Maharani** - PBO TRPL 1B

**Institusi:** [Sekolah Teknologi Tinggi]

**Tanggal:** Juni 2026

---

## Lisensi
Proyek pendidikan - Tugas UAS PBO

---

**Selamat menggunakan Sistem Tiket Bioskop! 🎬**
