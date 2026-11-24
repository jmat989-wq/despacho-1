
let todosLosDatos = JSON.parse(localStorage.getItem("Sesion")) || {};

if(!todosLosDatos["cliente"]){
    todosLosDatos["cliente"] = [];
}



console.log(todosLosDatos)


const formulario = document.getElementById("formulario");
formulario.addEventListener("submit",(e)=>{
    e.preventDefault()
    let nombreUsuario = document.getElementById("nombre");
    let telefonoUsuario = document.getElementById("telefono");
    console.log(nombreUsuario.value);
    console.log(telefonoUsuario.value);

    let nombreUsuarioCliente = nombreUsuario.value;
    let telefonoUsarioCliente = telefonoUsuario.value;

    let clientes = {"nombre": nombreUsuarioCliente, "telefono": telefonoUsarioCliente };
    todosLosDatos["cliente"].push(clientes);

    localStorage.setItem("Sesion", JSON.stringify(todosLosDatos))
    formulario.reset();  
})


const cuerpoTabla = document.getElementById("cuerpo-tabla");

document.addEventListener("DOMContentLoaded", (e)=>{
   


    console.log(todosLosDatos["cliente"].length)
    for(let i = 0; i < todosLosDatos["cliente"].length; i++){
        const createElementTr = document.createElement("tr");
        const crearElementoNombre = document.createElement("td");
        const crearElementoTelefono = document.createElement("td");
        const crearElementoConsulta = document.createElement("td");
        crearElementoNombre.textContent = todosLosDatos["cliente"][i].nombre;
        crearElementoTelefono.textContent = todosLosDatos["cliente"][i].telefono;
        crearElementoConsulta.textContent = "acciones";

        createElementTr.appendChild(crearElementoNombre);
        createElementTr.appendChild(crearElementoTelefono);
        createElementTr.appendChild(crearElementoConsulta);

        cuerpoTabla.appendChild(createElementTr);
       
    
        console.log(todosLosDatos["cliente"][i])
    }

});






