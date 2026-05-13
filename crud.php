

<?php
/*
    CRUD principal de usuarios
    Maneja listado, creación, edición y eliminación de usuarios.
*/
?>

<?php

$sql = "SELECT * FROM usuarios";
$stmt = $conn->prepare($sql);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$editData = null;
$error = "";

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
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $ciudad = trim($_POST['ciudad'] ?? '');
    $pais = trim($_POST['pais'] ?? '');
    $celular = trim($_POST['celular'] ?? '');

    if (
        empty($nombre) ||
        empty($correo) ||
        empty($ciudad) ||
        empty($pais) ||
        empty($celular)
    ) {
        $error = "Todos los campos son obligatorios";
    }

    if (!$error && !preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,}$/', $nombre)) {
        $error = "Nombre inválido";
    }

    if (!$error && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = "Correo inválido";
    }

    if (!$error && !preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $ciudad)) {
        $error = "Ciudad inválida";
    }

    if (!$error && !preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $pais)) {
        $error = "País inválido";
    }

    if (!$error && !preg_match('/^[0-9]{7,}$/', $celular)) {
        $error = "Celular inválido";
    }

    if (!$error) {

        try {

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

        } catch (PDOException $e) {

            if ($e->getCode() == 23000) {
                $error = "Este correo ya está registrado";
            } else {
                $error = "Error en la base de datos";
            }
        }
    }
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