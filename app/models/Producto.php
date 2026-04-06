<?php

require_once 'Conexion.php';

class Producto extends Conexion
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = parent::getConexion();
  }


  public function listar(): array
  {
    try {
      $sql = "
        SELECT 
          IT, codigo, cliente, categoria, ubicacion,
          medida, cantidad, fecha_inicio, fecha_termino, estado
        FROM productos
      ";

      $consulta = $this->pdo->prepare($sql);
      $consulta->execute();

      return $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
      return [];
    }
  }

 
  public function registrar($registro = []): int
  {
    try {

      $sql = "
        INSERT INTO productos 
        (codigo, cliente, categoria, ubicacion, medida, cantidad, fecha_inicio, fecha_termino, estado)
        VALUES (?,?,?,?,?,?,?,?,?)
      ";

      $consulta = $this->pdo->prepare($sql);

      $consulta->execute([
        $registro['codigo'],
        $registro['cliente'],
        $registro['categoria'],
        $registro['ubicacion'],
        $registro['medida'],
        $registro['cantidad'],
        $registro['fecha_inicio'],
        $registro['fecha_termino'],
        $registro['estado']
      ]);

      return $this->pdo->lastInsertId();

    } catch (Exception $e) {
      return -1;
    }
  }


  public function eliminar($IT): int
  {
    try {
      $sql = "DELETE FROM productos WHERE IT = ?";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute([$IT]);

      return $consulta->rowCount();

    } catch (Exception $e) {
      return -1;
    }
  }


  public function actualizar($registro = []): int
  {
    try {

      $sql = "
        UPDATE productos SET
          codigo = ?,
          cliente = ?,
          categoria = ?,
          ubicacion = ?,
          medida = ?,
          cantidad = ?,
          fecha_inicio = ?,
          fecha_termino = ?,
          estado = ?
        WHERE IT = ?
      ";

      $consulta = $this->pdo->prepare($sql);

      $consulta->execute([
        $registro['codigo'],
        $registro['cliente'],
        $registro['categoria'],
        $registro['ubicacion'],
        $registro['medida'],
        $registro['cantidad'],
        $registro['fecha_inicio'],
        $registro['fecha_termino'],
        $registro['estado'],
        $registro['IT']
      ]);

      return $consulta->rowCount();

    } catch (Exception $e) {
      return -1;
    }
  }


  // OBTENER POR ID (PARA EDITAR)
 
  public function obtener(int $IT): array
  {
    try {
      $sql = "SELECT * FROM productos WHERE IT = ?";

      $consulta = $this->pdo->prepare($sql);
      $consulta->execute([$IT]);

      return $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
      return [];
    }
  }

  
  // BUSCAR POR ID
 
  public function buscarPorId(int $IT): array
  {
    try {
      $sql = "SELECT * FROM productos WHERE IT = ?";

      $consulta = $this->pdo->prepare($sql);
      $consulta->execute([$IT]);

      return $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
      return [];
    }
  }

  
  // BUSCAR POR CATEGORÍA
 
  public function buscarPorCategoria(string $categoria): array
  {
    try {
      $sql = "SELECT * FROM productos WHERE categoria = ?";

      $consulta = $this->pdo->prepare($sql);
      $consulta->execute([$categoria]);

      return $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
      return [];
    }
  }

  // 📊 ESTADÍSTICAS GENERALES
public function estadisticas() {
  try {
    $sql = "
      SELECT 
        COUNT(*) as total_productos,
        SUM(cantidad) as total_stock,
        AVG(DATEDIFF(fecha_termino, fecha_inicio)) as promedio_dias
      FROM productos
    ";

    $consulta = $this->pdo->prepare($sql);
    $consulta->execute();

    return $consulta->fetch(PDO::FETCH_ASSOC);

  } catch (Exception $e) {
    return [];
  }
}
// 📦 POR CATEGORÍA
public function categorias() {
  $sql = "SELECT categoria, COUNT(*) as total FROM productos GROUP BY categoria";
  return $this->pdo->query($sql);
}

// 📊 POR ESTADO
public function estados() {
  $sql = "SELECT estado, COUNT(*) as total FROM productos GROUP BY estado";
  return $this->pdo->query($sql);
}

}