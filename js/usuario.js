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
            let avatar='';
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
            avatar+=`${usuario.avatar}`;
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
            $('#avatar1').attr('src',usuario.avatar);
            $('#avatar2').attr('src',usuario.avatar);
            $('#avatar3').attr('src',usuario.avatar);
            $('#avatar4').attr('src',usuario.avatar);
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
    //para cambiar la clave del usuario se usa el submit para capturar los datos//
    $('#form-clave').submit(e=>{
        let vieja_clave=$('#clave-vieja').val();
        let nueva_clave=$('#clave-nueva').val();
        //console.log(vieja_clave + nueva_clave);
        // es para que no se refresco los valores del inputs//
        funcion='cambiar_clave';
        $.post('../controlador/usuario-controlador.php',{Id_usuario,funcion,vieja_clave,nueva_clave},(response)=>{
            //console.log(response);
            if (response=='actualizado') {
                    $('#actualizado').hide('slow');
                    $('#actualizado').show(1000);
                    $('#actualizado').hide(2000);
                    $('#form-clave').trigger('reset');
            }else{
                $('#no-actualizado').hide('slow');
                $('#no-actualizado').show(1000);
                $('#no-actualizado').hide(2000);
                $('#form-clave').trigger('reset');
            }
        })
        e.preventDefault();
    })
    $('#form-foto').submit(e=>{
        let formData=new FormData($('#form-foto')[0]);
        $.ajax({
            url:'../controlador/usuario-controlador.php',
            type:'POST',
            data:formData,
            cache:false,
            processData:false,
            contentType:false
        }).done(function(response){
            console.log(response);
            const json=JSON.parse(response);
            if (json.alert=='editado') {
                $('#avatar1').attr('src',json.ruta);
                $('#update').hide('slow');
                $('#update').show(1000);
                $('#update').hide(2000);
                $('#form-foto').trigger('reset');
                buscar_usuario(Id_usuario);    
            }else{
                $('#no-update').hide('slow');
                $('#no-update').show(1000);
                $('#no-update').hide(2000);
                $('#form-foto').trigger('reset');    
            }
            
        });
        e.preventDefault();
    })
})