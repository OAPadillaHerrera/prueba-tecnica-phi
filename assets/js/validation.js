

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formUsuario");

    form.addEventListener("submit", function(e) {

        const inputs = this.querySelectorAll("input:not([type='hidden'])");

        for (let input of inputs) {
            if (input.value.trim() === "") {
                e.preventDefault();
                alert("Todos los campos son obligatorios");
                return;
            }
        }

        const nombre = form.nombre.value.trim();
        const correo = form.correo.value.trim();
        const ciudad = form.ciudad.value.trim();
        const pais = form.pais.value.trim();
        const celular = form.celular.value.trim();

        const nombreRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,}$/;
        const textoRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const celularRegex = /^[0-9]{7,}$/;

        if (!nombreRegex.test(nombre)) {
            e.preventDefault();
            alert("Nombre inválido (solo letras, mínimo 2 caracteres)");
            return;
        }

        if (!emailRegex.test(correo)) {
            e.preventDefault();
            alert("Correo inválido");
            return;
        }

        if (!textoRegex.test(ciudad)) {
            e.preventDefault();
            alert("Ciudad inválida (solo letras)");
            return;
        }

        if (!textoRegex.test(pais)) {
            e.preventDefault();
            alert("País inválido (solo letras)");
            return;
        }

        if (!celularRegex.test(celular)) {
            e.preventDefault();
            alert("Celular inválido (solo números, mínimo 7 dígitos)");
            return;
        }

    });

});