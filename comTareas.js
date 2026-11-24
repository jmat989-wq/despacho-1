const formulario = document.getElementById("formulario-tarea");
const selecionCliente = document.getElementById("cliente-referido");
let todosLosDatos = [];
const cuerpoTabla = document.getElementById("cuerpo-tabla-tareas");

todosLosDatos.push(JSON.parse(localStorage.getItem("sesion")));
todosLosClientes = JSON.parse(localStorage.getItem("cliente"));

console.log(todosLosDatos);

document.addEventListener("DOMContentLoaded", () => {
    if (todosLosDatos != null) {
        for (let i = 0; i < todosLosDatos.length; i++) {
            const tr = document.createElement("tr");

            const tdFechaCrea = document.createElement("td");
            const tdConcepto = document.createElement("td");
            const tdCliente = document.createElement("td");
            const tdFechaFin = document.createElement("td");

            tdFechaCrea.textContent = todosLosDatos["fechaCreacion"][i];
            tdConcepto.textContent = todosLosDatos["concepto"][i];
            tdCliente.textContent = todosLosDatos["cliente"][i];
            tdFechaFin.textContent = todosLosDatos["fechaFin"][i];

            tr.appendChild(tdFechaCrea);
            tr.appendChild(tdConcepto);
            tr.appendChild(tdCliente);
            tr.appendChild(tdFechaFin);

            cuerpoTabla.appendChild(tr);
        }
    }
    if (todosLosClientes) {
        for (let i = 0; i < todosLosDatos["cliente"].length; i++) {
            let option = document.createElement("option");
            option.value = todosLosDatos["cliente"][i].nombre;
            option.textContent = todosLosDatos["cliente"][i].nombre;
            selecionCliente.appendChild(option);
        }
    }
});




formulario.addEventListener("submit", function (event) {
    console.log(todosLosDatos);
    event.preventDefault();
    debugger
    let concepto = formulario.concepto.value;
    let cliente =  formulario.clienteReferido.value;
    let fechaFin = formulario.fechafin.value;
    let nuevaTarea = {
        "concepto": concepto,
        "cliente": cliente,
       // "fechaCreacion": fechaCreacion,
        "fechaFin": fechaFin
    };
    todosLosDatos.push(nuevaTarea);
    localStorage.setItem("sesion", JSON.stringify(todosLosDatos).toString);
});




