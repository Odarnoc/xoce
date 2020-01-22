function buscarProducto() {
    let td, i, txtValue;
    let input = document.getElementById('inputsearchproducto').value.toLowerCase();
    let table = document.getElementById('tablaproductos');
    let tr = table.getElementsByTagName('tr');
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName('td')[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toLowerCase().indexOf(input) > -1) {
                tr[i].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }
    }
}