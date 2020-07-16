$(document).ready(function(){
    let funcion="listar";
    //$.post('../controlador/controlador-venta.php',{funcion},(response)=>{
      //  console.log(JSON.parse(response));
    //})
    //uso del datatable//
    $('#tabla_venta').DataTable( {
        "ajax": {
            "url":'../controlador/controlador-venta.php',
            "method":'POST',
            "data":{function:funcion}
        },
        "columns": [
            { "data": "Id_venta" },
            { "data": "fecha" },
            { "data": "cliente" },
            { "data": "cedula" },
            { "data": "total" },
            { "data": "vendedor" }
        ]
    } );
})