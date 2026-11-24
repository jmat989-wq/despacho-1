
const formLogin = document.getElementById("formLogin");
const btnLogin = document.querySelector("#btnLogin");
const username = document.querySelector("#username");
const password = document.querySelector("#pass");
formLogin.addEventListener(`submit`, (event) =>{
    event.preventDefault()
    let usuario = "";
    let clave = "";
    const usuarioLogueado = JSON.parse(localStorage.getItem("confUsuario"));
    usuario = usuarioLogueado.usuario;
    clave = usuarioLogueado.password;
    
   
    
     if (username.value ===`` || password.value ===``) {
         alert (`Por favor, complete todos los campos`);
    }

     else if ( username.value === usuario && password.value === clave) {
         
       window.location.href = "./dashboard.html";
    
     }

 })
