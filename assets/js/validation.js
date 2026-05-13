

console.log("JS FILE OK");

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

});