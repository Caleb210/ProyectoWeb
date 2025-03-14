// Función para mostrar alertas
function mostrarAlerta(idAlerta) {
  ocultarTodasAlertas();
  document.getElementById(idAlerta).classList.remove("d-none");
}

// Función para ocultar todas las alertas
function ocultarTodasAlertas() {
  document.querySelectorAll(".alert").forEach((alerta) => {
    alerta.classList.add("d-none");
  });
}

// Función para validar la cédula ingresada
function validar() {
  let cedula = document.getElementById("cedula").value.trim();

  // Validar que la cédula no esté vacía y sea un número válido
  if (cedula === "" || isNaN(cedula) || cedula <= 0) {
    mostrarAlerta("alertaAmarilla");
    return;
  }

  // Simulación de una API para verificar la cédula
  validarCedulaEnServidor(cedula)
    .then((existe) => {
      if (existe) {
        mostrarAlerta("alertaVerde");
      } else {
        mostrarAlerta("alertaRoja");
      }
    })
    .catch(() => {
      mostrarAlerta("alertaRoja");
    });
}

// Simulación de una API con promesa (debería ser una llamada real a un backend)
function validarCedulaEnServidor(cedula) {
  return new Promise((resolve) => {
    let autoridades = [
      { cedula: "12345678" },
      { cedula: "87654321" },
    ]; // Datos simulados

    let existe = autoridades.some((autoridad) => autoridad.cedula === cedula);
    setTimeout(() => resolve(existe), 1000); // Simula retardo de servidor
  });
}
