document.addEventListener('DOMContentLoaded', function(){
    mostrarNoty();
})
function mostrarNoty() {
    let url = base_url + 'admin/pedidos/total';
    const http = new XMLHttpRequest();
    http.open('GET', url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.querySelector('#totalPedidos').textContent = res.data.id;
        }
    }
}