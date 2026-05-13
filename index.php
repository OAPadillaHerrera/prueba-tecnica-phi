

<?php

require "config/database.php";

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

$editData = null;

if (isset($_GET['edit'])) {

    $id = $_GET['edit'];

    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $editData = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_POST) {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $celular = $_POST['celular'];

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

$sql = "SELECT * FROM usuarios";
$stmt = $conn->prepare($sql);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h2>Registro de Usuarios</h2>

<form method="POST">

    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

    <input type="text" name="nombre" class="form-control mb-2"
    placeholder="Nombre" value="<?= $editData['nombre'] ?? '' ?>" required>

    <input type="email" name="correo" class="form-control mb-2"
    placeholder="Correo" value="<?= $editData['correo'] ?? '' ?>" required>

    <input type="text" name="ciudad" class="form-control mb-2"
    placeholder="Ciudad" value="<?= $editData['ciudad'] ?? '' ?>" required>

    <input type="text" name="pais" class="form-control mb-2"
    placeholder="País" value="<?= $editData['pais'] ?? '' ?>" required>

    <input type="text" name="celular" class="form-control mb-2"
    placeholder="Celular" value="<?= $editData['celular'] ?? '' ?>" required>

    <button type="submit" class="btn btn-primary">
        <?= $editData ? "Actualizar" : "Guardar" ?>
    </button>

</form>

<h3 class="mt-5">Listado de Usuarios</h3>

<table class="table table-bordered mt-2">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Ciudad</th>
            <th>País</th>
            <th>Celular</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach($usuarios as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= $u['nombre'] ?></td>
            <td><?= $u['correo'] ?></td>
            <td><?= $u['ciudad'] ?></td>
            <td><?= $u['pais'] ?></td>
            <td><?= $u['celular'] ?></td>

            <td>
                <a href="?edit=<?= $u['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="?delete=<?= $u['id'] ?>" class="btn btn-danger btn-sm"
                   onclick="return confirm('¿Eliminar este usuario?')">
                   Eliminar
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

    </tbody>

</table>

</body>
</html>