const formulario = document.getElementById("registro");
const usuario = document.getElementById(`rUsername`);
    const pass = document.getElementById(`pass`);
    const pass2 = document.getElementById(`pass2`);

formulario.addEventListener("submit", function (event) {
    
    event.preventDefault();
    
    console.log(usuario.value)
    if (usuario.value === `` || pass.value === `` || pass2.value === ``) {
        alert(`Por favor, complete todos los campos.`);

    } else if (pass.value != pass2.value) {
        alert(`Las contraseñas no coinciden.`);
    } else if (pass.value.length < 4) {
        alert(`La contraseña debe tener cuatro caracteres`);
    } else {
        const datosUsuario = {
            usuario: usuario.value,
            password: pass.value
        };

        localStorage.setItem("confUsuario", JSON.stringify(datosUsuario));
        
        alert("Registro completado correctamente");
       
        
        window.location.href = "./index.html";
        }
    
});


