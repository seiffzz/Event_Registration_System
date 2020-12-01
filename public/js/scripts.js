function show_modal(id) {
    document.getElementById(id).classList.toggle('hidden')
}

window.onload = function () {
    $(".alert").fadeOut(5000);

}
$(document).ready(function () {
    $('#example').DataTable({
        scrollY: 270,
        scrollX: true
    });
});

function show() {
    var role = document.getElementById('role').value;
    if (role !== 'New Member' && role !== 'LCP' && role !== 'MCVP' && role !== 'MCP') {
        document.getElementById('function-dropdown').className = 'mt-6'
    } else {
        document.getElementById('function-dropdown').className = 'mt-6 hidden'
    }
}
