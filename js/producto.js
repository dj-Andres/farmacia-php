$(document).ready(function(){
    var funcion;
    //uso de la libreria select2//
    $('.select2').select2();
    rellenar_laboratorios();
    rellenar_presentacion();
    rellenar_tipos();
    function rellenar_laboratorios() {
        funcion="rellenar_laboratorios";
        $.post('../controlador/controlador-laboratorio.php',{funcion},(response)=>{
            //console.log(response);
            const laboratorios=JSON.parse(response);
            let template='';
            laboratorios.forEach(laboratorio => {
                template+=`
                    <option value="${laboratorio.Id_laboratorio}">${laboratorio.nombre}</option>
                `;
            });
            $('#laboratorio').html(template);
        })
    }
    function rellenar_presentacion() {
        funcion="rellenar_presentacion";
        $.post('../controlador/controlador-presentacion.php',{funcion},(response)=>{
            //console.log(response);
            const presentaciones=JSON.parse(response);
            let template='';
            presentaciones.forEach(presentacion => {
                template+=`
                    <option value="${presentacion.Id_presentacion}">${presentacion.nombre}</option>
                `;
            });
            $('#presentacion').html(template);
        })
    }
    function rellenar_tipos() {
        funcion="rellenar_tipos";
        $.post('../controlador/controlador-tipo.php',{funcion},(response)=>{
            //console.log(response);
            const tipos=JSON.parse(response);
            let template='';
            tipos.forEach(tipo => {
                template+=`
                    <option value="${tipo.Id_tipo}">${tipo.nombre_tipo}</option>
                `;
            });
            $('#tipo_producto').html(template);
        })
    }
    $('#form-crear-producto').submit(e=>{
        let nombre=$('#nombre_producto').val();
        let concentracion=$('#concentracion').val();
        let precio=$('#precio').val();
        let laboratorio=$('#laboratorio').val();
        let tipo=$('#tipo_producto').val();
        let presentacion=$('#presentacion').val();
        console.log(nombre+" "+concentracion);
        e.PreventDefault(); 
    });
})