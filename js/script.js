let opcionSeleccionada = null;

function seleccionarCandidato(opcion, elemento) {
    opcionSeleccionada = opcion;

    // Actualizar visualmente la selección
    document.querySelectorAll(".opcion-container").forEach(el => {
        el.classList.remove("seleccionado");
    });
    elemento.classList.add("seleccionado");

    // Habilitar el botón de confirmación
    document.getElementById("confirmar-btn").disabled = false;
}

function mostrarModal() {
    if (!opcionSeleccionada) return;
    document.getElementById("candidato-seleccionado").textContent = opcionSeleccionada;
    document.getElementById("modal").classList.remove("hidden");
}

function cerrarModal() {
    document.getElementById("modal").classList.add("hidden");
}

function confirmarVoto() {
    if (opcionSeleccionada) {
        const codigoVerificacion = generarCodigoVerificacion();
        
        document.getElementById("comprobante-texto").innerHTML = `
            <strong>Ha votado por:</strong> ${opcionSeleccionada}<br>
            <strong>Código de verificación:</strong> ${codigoVerificacion}
        `;
        
        document.getElementById("comprobante").classList.remove("hidden");
        document.getElementById("modal").classList.add("hidden");

        // Desactivar opciones después de votar
        document.querySelectorAll(".opcion-container").forEach(el => {
            el.style.pointerEvents = "none";
            el.style.opacity = "0.5";
        });

        document.getElementById("confirmar-btn").disabled = true;
    }
}

function generarCodigoVerificacion() {
    return Math.random().toString(36).substring(2, 10).toUpperCase();
}
