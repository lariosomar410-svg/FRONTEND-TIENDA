<?php

declare(strict_types=1);

class Tarea 
{
    private PDO $conexion;

    public function __construct(PDO $db) 
    {
        $this->conexion = $db;
    }

    public function obtenerTodas(): array 
    {
        $stmt = $this->conexion->query("SELECT id, titulo, descripcion, completada FROM tareas");
        return $stmt->fetchAll();
    }

    public function crear(string $titulo, string $descripcion): bool 
    {
        $stmt = $this->conexion->prepare("INSERT INTO tareas (titulo, descripcion) VALUES (:titulo, :descripcion)");
        return $stmt->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion
        ]);
    }
}