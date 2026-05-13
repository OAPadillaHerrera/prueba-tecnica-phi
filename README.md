

# prueba-tecnica-phi

Aplicación CRUD desarrollada como prueba técnica para Proyección Humana Internacional SAS usando PHP, JavaScript, HTML, CSS, Bootstrap y MySQL.

Repositorio:
`prueba-tecnica-phi`

---

## Características

- Crear usuarios
- Listar usuarios
- Editar usuarios
- Eliminar usuarios
- Validaciones frontend con JavaScript
- Validaciones backend con PHP
- Prevención de correos duplicados
- Manejo básico de errores
- Diseño responsive con Bootstrap
- Conexión segura usando variables de entorno

---

## Tecnologías utilizadas

- PHP
- JavaScript
- HTML5
- CSS3
- Bootstrap 5
- MySQL
- PDO

---

## Estructura del proyecto

```bash
prueba-tecnica-phi/
│
├── assets/
│   └── js/
│       └── validation.js
│
├── config/
│   ├── database.php
│   └── database.sql
│
├── crud.php
├── footer.php
├── header.php
├── index.php
├── .env.example
├── .gitignore
└── README.md
```

---

## Requisitos

- PHP 8 o superior
- MySQL
- Servidor local (Laragon, XAMPP o similar)

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/OAPadillaHerrera/prueba-tecnica-phi.git
```

---

### 2. Crear la base de datos

Ejecutar el archivo:

```bash
config/database.sql
```

Este script crea la base de datos y la tabla necesaria para el funcionamiento del proyecto.

---

### 3. Configurar variables de entorno

Crear un archivo `.env` basado en `.env.example`:

```env
DB_HOST=localhost
DB_NAME=phi_crud
DB_USER=root
DB_PASS=
```

---

### 4. Ejecutar el proyecto

Ubicar el proyecto en el servidor local y acceder desde el navegador:

```bash
http://localhost/prueba-tecnica-phi
```

---

## Validaciones implementadas

### Frontend

- Campos obligatorios
- Validación de formato de correo
- Validación de texto en nombre, ciudad y país
- Validación numérica para celular

### Backend

- Validación de campos vacíos
- Validación de formatos
- Prevención de registros duplicados
- Manejo básico de errores

---

## Autor

Desarrollado por Oscar Padilla como prueba técnica para Proyección Humana Internacional SAS.
