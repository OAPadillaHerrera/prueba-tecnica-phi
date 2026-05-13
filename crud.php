

<?php

$sql = "SELECT * FROM usuarios";
$stmt = $conn->prepare($sql);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$editData = null;

if (isset($_GET['edit'])) {

    $id = $_GET['edit'];

    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $editData = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $ciudad = $_POST['ciudad'] ?? '';
    $pais = $_POST['pais'] ?? '';
    $celular = $_POST['celular'] ?? '';

    if (
        empty($nombre) ||
        empty($correo) ||
        empty($ciudad) ||
        empty($pais) ||
        empty($celular)
    ) {
        die("Todos los campos son obligatorios");
    }

    if ($id == "") {

        $sql = "INSERT INTO usuarios (nombre, correo, ciudad, pais, celular)
                VALUES (:nombre, :correo, :ciudad, :pais, :celular)";

        $stmt = $conn->prepare($sql);

    } else {

        $sql = "UPDATE usuarios 
                SET nombre=:nombre, correo=:correo, ciudad=:ciudad, pais=:pais, celular=:celular
                WHERE id=:id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
    }

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':ciudad', $ciudad);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':celular', $celular);

    $stmt->execute();

    header("Location: index.php");
    exit;
}

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}