<?php

class ConexionBD {

    private static ?PDO $conexion = null;

    public static function obtener(): PDO {

        if (self::$conexion === null) {
            $host = "localhost";
            $puerto = "5432";
            $dbname = "sigech";
            $usuario = "postgres";
            $password = "password";

            $dsn = "pgsql:host=$host;port=$puerto;dbname=$dbname";

            try {
                self::$conexion = new PDO($dsn, $usuario, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Error al conectar con PostgreSQL: " . $e->getMessage());
            }
        }

        return self::$conexion;
    }
}
