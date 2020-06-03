//Selector de elementos de Jquery esta funcion es para cargar los elementos de una pagina cargada//
$(document).ready(function(){
    var funcion='';
    //capturams los id de las paginas//
    var Id_usuario=$('#Id_usuario').val();
    //variable para permitir el funcionamiento del boton de edicion//
    var edit=false;
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
        })
    }
    // el evento  ON es para capturar una clase  se coloca . cuando son ID se coloca#//
    // el (e)=> es para crear un evento//
    $(document).on('click','edit',(e)=>{
        funcion='capturar_datos';
        edit=true;
        $.post('../controlador/usuario-controlador.php',{funcion,Id_usuario},(response)=>{
            //para prueba de mostrar en la consola del navegador que datos nos muestra en el boton de edicion//
            //console.log(response);
            //funcion para devolver los datos a los imputs en la plantilla de eidicion de datos response"es la el json decodificado del controlador es decir los datos obtenidos de la consulta"//
            const usuario=JSON.parse(response);
            $('#telefono').val(usuario.telefono);
            $('#residencia').val(usuario.residencia);
            $('#correo').val(usuario.coreeo);
            $('#sexo').val(usuario.sexo);
            $('#adicional').val(usuario.adicional);
        })
    });
    //es el ID del formulario para guardar los datos que se vayana a editar esta es solo para analizar los datos que se vaya editar//
    $('#form-usuario').submit(e=>{
        if(edit==true){
            //capturar los datos del inputs del formulario de edicion//
            // let se usa para usar variables locales en una funcion//
            let telefono=$('#telefono').val();
            let residencia=$('#residencia').val();
            let correo=$('#correo').val();
            let sexo=$('#sexo').val();
            let adicional=$('#adicioanl').val();
            funcion='editar_usuario';
            $.post('../controlador/usuario-controlador.php',{Id_usuario,funcion,telefono,residencia,correo,sexo,adicional},(response)=>{
                if(response=='edicion'){
                    $('#editado').hide('slow');
                    $('#editado').show(1000);
                    $('#editado').hide(2000);
                    // limpiamos la caja de texto despues que se ejecuto la actualizacion//
                    $('#form-usuario').trigger('reset');
                }else{
                    edit=false;
                    buscar_usuario(Id_usuario);
                }
            })
        }else{
            $('#no-editado').hide('slow');
            $('#no-editado').show(1000);
            $('#no-editado').hide(2000);
            $('#form-usuario').trigger('reset');
        }
        // elimino la funcion del boton//
        e.preventDefault();
    });
})