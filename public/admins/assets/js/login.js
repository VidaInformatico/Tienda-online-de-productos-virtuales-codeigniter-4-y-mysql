let myModal;
const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container-login");

sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
});
document.addEventListener('', function () {
    if (document.getElementById('myModal')) {
        myModal = new bootstrap.Modal(document.getElementById('myModal'));
    }
})
function frmLogin(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");
    if (usuario.value == "") {
        alertas('EL USUARIO ES REQUERIDO', 'warning');
        usuario.focus();
    } else if (clave.value == "") {
        alertas('LA CONTRASEÑA ES REQUERIDO', 'warning');
        clave.focus();
    } else {
        const url = base_url + "usuarios/validar";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.upload.addEventListener('progress', function () {
            document.getElementById('btnAccion').textContent = 'Procesando';
        });
        http.send(new FormData(frm));
        http.addEventListener('load', function () {
            document.getElementById('btnAccion').textContent = 'Login';
        });
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    let timerInterval;
                    Swal.fire({
                        title: "Bienvenido al Sistema",
                        html: "Será Redireccionado en <b></b> milisegundos...",
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            timerInterval = setInterval(() => {
                                const content = Swal.getHtmlContainer();
                                if (content) {
                                    const b = content.querySelector("b");
                                    if (b) {
                                        b.textContent = Swal.getTimerLeft();
                                    }
                                }
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        },
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location = base_url + "administracion/home";
                        }
                    });
                } else {
                    document.getElementById('btnAccion').textContent = 'Login';
                    document.getElementById("alerta").classList.remove("d-none");
                    document.getElementById("alerta").innerHTML = res;
                }
            }
        }
    }
}
function registroPlan(e) {
    e.preventDefault();
    const plan = document.getElementById("plan").value;
    const identidad = document.getElementById("identidad").value;
    const nombre = document.getElementById("nombre").value;
    const celular = document.getElementById("celular").value;
    const direccion = document.getElementById("direccion").value;
    const ciudad = document.getElementById("direccion").ciudad;
    if (plan == '' || identidad == '' || nombre == '' || celular == '' || direccion == ''
    || ciudad == '') {
         Swal.fire({
             icon: 'warning',
             title: 'Aviso!',
             text: 'Todo los campos es requerido',
         })
    } else {
        const url = base_url + 'home/registrar';
        const frm = document.getElementById("frmRegister");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.upload.addEventListener('progress', function () {
            document.getElementById('btnAccion').textContent = 'Procesando';
        });
        http.send(new FormData(frm));
        http.addEventListener('load', function () {
            document.getElementById('btnAccion').textContent = 'Registro';
        });
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                
                const res = JSON.parse(this.responseText);
                if (res.icono == 'success') {
                    frm.reset();
                }
                Swal.fire({
                    icon: res.icono,
                    title: 'Aviso!',
                    text: res.msg,
                })
            }
        }
    }
}