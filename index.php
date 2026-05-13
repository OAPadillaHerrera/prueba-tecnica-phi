

<?php

require "config/database.php";
require "crud.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h2>Registro de Usuarios</h2>

<form method="POST" id="formUsuario" novalidate>

    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

    <input type="text" name="nombre" class="form-control mb-2"
    placeholder="Nombre" value="<?= $editData['nombre'] ?? '' ?>">

    <input type="email" name="correo" class="form-control mb-2"
    placeholder="Correo" value="<?= $editData['correo'] ?? '' ?>">

    <input type="text" name="ciudad" class="form-control mb-2"
    placeholder="Ciudad" value="<?= $editData['ciudad'] ?? '' ?>">

    <input type="text" name="pais" class="form-control mb-2"
    placeholder="País" value="<?= $editData['pais'] ?? '' ?>">

    <input type="text" name="celular" class="form-control mb-2"
    placeholder="Celular" value="<?= $editData['celular'] ?? '' ?>">

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

<script src="assets/js/validation.js"></script>

</body>
</html>