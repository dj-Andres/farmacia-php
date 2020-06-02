//Selector de elementos de Jquery esta funcion es para cargar los elementos de una pagina cargada//
$(document).ready(function(){
    var funcion='';
    //capturams los id de las paginas//
    var Id_usuario=$('#Id_usuario').val();
    //console.log(Id_usuario)
    buscar_usuario(Id_usuario);
    function buscar_usuario(dato){
        //funcion ajax para obtener los datos del usuario//
        funcion='buscar_usuario';
        $.post('../contralador/usuario-controlador.php',{dato,funcion},(response)=>{
            let nombre='';
            let apellido='';
            let edad='';
            let cedula='';
            let tipo='';
            let telefono='';
            let residencia='';
            let correo='';
            let sexo='';
            let adicional='';
            //let tipo_usuario='';
            //JSON.parse convierte  el json encode del controlador y convierte a int al string del controlador//
            const usuario=JSON.parse(response);
            // recorremos el json//
            nombre+=`${usuario.nombre}`;
            apellido+=`${usuario.apellido}`;
            edad+=`${usuario.edad}`;
            cedula+=`${usuario.cedula}`;
            tipo+=`${usuario.tipo}`;
            telefono+=`${usuario.telefono}`;
            residencia+=`${usuario.residencia}`;
            coreeo+=`${usuario.correo}`;
            sexo+=`${usuario.sexo}`;
            adicional+=`${usuario.adicional}`;
            // se pasara los datos a la plantilla//
            $('#nombre').html(nombre);
            $('apellido').html(apellido);
            $('#cedula').html(cedula);
            $('#edad').html(edad);
            $('#us_tipo').html(tipo);
            $('#telefono').html(telefono);
            $('#sexo').html(sexo);
            $('#correo').html(correo);
            $('#residencia').html(residencia);
            $('#adicional').html(adicional);
        });
    }
});