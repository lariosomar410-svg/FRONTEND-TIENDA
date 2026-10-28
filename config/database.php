<?php

declare(strict_types=1);

class Database 
{
    private string $host = '127.0.0.1';
    private string $db = 'mini_api_db';
    private string $user = 'root';
    private string $pass = ''; // Ajusta la contraseña según tu entorno
    private string $charset = 'utf8mb4';

    public function obtenerConexion(): PDO 
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        
        $opciones = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            return new PDO($dsn, $this->user, $this->pass, $opciones);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error de conexión a la base de datos: ' . $e->getMessage()]);
            exit;
        }
    }
}