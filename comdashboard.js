const bienvenida = document.getElementById("welcome-msg");
const logoutBtn = document.getElementById("logout-btn");

document.addEventListener("DOMContentLoaded", () => {
      const usuarioLogueado = JSON.parse(localStorage.getItem("confUsuario"));
    bienvenida.textContent = "Bienvenido " + usuarioLogueado.usuario;
    
    logoutBtn.addEventListener("click", () => {
        
        window.location.href = "index.html";
});
});

