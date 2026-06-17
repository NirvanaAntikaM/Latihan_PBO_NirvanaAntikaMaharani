<?php
/**
 * Database Connection Configuration
 * File untuk menghubungkan aplikasi dengan database MySQL
 */

class Database {
    // Konfigurasi database
    private $host = 'localhost';
    private $port = 3306;
    private $db_name = 'db_latihan_pbo_trpl1b_nirvanaantikamaharani';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    
    // Koneksi PDO
    private $pdo;
    
    /**
     * Constructor - Membuka koneksi ke database
     */
    public function __construct() {
        $this->connect();
    }
    
    /**
     * Method untuk menghubungkan ke database
     */
    private function connect() {
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset={$this->charset}";
            
            $this->pdo = new PDO(
                $dsn,
                $this->username,
                $this->password,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                )
            );
            
            // Koneksi berhasil
            // echo "Database connection successful!";
        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }
    
    /**
     * Method untuk mendapatkan objek PDO
     * @return PDO
     */
    public function getConnection() {
        return $this->pdo;
    }
    
    /**
     * Method untuk menjalankan query SELECT
     * @param string $query - Query SQL
     * @param array $params - Parameter untuk prepared statement
     * @return array - Array hasil query
     */
    public function query($query, $params = array()) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            die("Query Error: " . $e->getMessage());
        }
    }
    
    /**
     * Method untuk menjalankan query single row
     * @param string $query - Query SQL
     * @param array $params - Parameter untuk prepared statement
     * @return array - Single row hasil query
     */
    public function queryRow($query, $params = array()) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            die("Query Error: " . $e->getMessage());
        }
    }
    
    /**
     * Method untuk menjalankan query INSERT/UPDATE/DELETE
     * @param string $query - Query SQL
     * @param array $params - Parameter untuk prepared statement
     * @return int - Jumlah baris yang dipengaruhi
     */
    public function execute($query, $params = array()) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Execute Error: " . $e->getMessage());
        }
    }
    
    /**
     * Method untuk disconnect dari database
     */
    public function disconnect() {
        $this->pdo = null;
    }
}
?>
