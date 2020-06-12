$(document).ready(function(){
    buscar_laboratorio();
    var funcion;
    var editar=false;
    //creacion de evento submit del modal de laboratorio//
   $('#form-crear-laboratorio').submit(e=>{
        let nombre_laboratorio=$('#nombre-laboratorio').val();
        let id_editado=$('#id_editar_lab').val();
        if (editar==false) {
            funcion='crear';
        }else{
            funcion='actualizar';
        }
        //funcion ajax estilo post//
        $.post('../controlador/controlador-laboratorio.php',{nombre_laboratorio,id_editado,funcion},(response)=>{
            //console.log(response);
            if(response=='crear'){
                $('#crear-laboratorio').hide('slow');
                $('#crear-laboratorio').show(1000);
                $('#crear-laboratorio').hide(2000);
                $('#form-crear-laboratorio').trigger('reset');
                buscar_laboratorio();
            }
            if(response=='nocrear'){
                $('#nocrear-laboratorio').hide('slow');
                $('#nocrear-laboratorio').show(1000);
                $('#nocrear-laboratorio').hide(2000);
                $('#form-crear-laboratorio').trigger('reset');
            }
            if(response=='editado'){
                $('#crear-laboratorio-edit').hide('slow');
                $('#crear-laboratorio-edit').show(1000);
                $('#crear-laboratorio-edit').hide(2000);
                $('#form-crear-laboratorio').trigger('reset');
                buscar_laboratorio();
            }
            editar==false;
        })
        e.preventDefault();
   });
   function buscar_laboratorio(consulta){
       funcion='buscar';
       $.post('../controlador/controlador-laboratorio.php',{consulta,funcion},(response)=>{
           //console.log(response);
            const laboratorios=JSON.parse(response);
            let template='';
            laboratorios.forEach(laboratorio => {
                template+=`
                    <tr labId="${laboratorio.Id_laboratorio}" labNom="${laboratorio.nombre}" labAvatar="${laboratorio.avatar}">
                        <td>${laboratorio.nombre}</td>
                        <td>
                            <img src="${laboratorio.avatar}" class="img-fluid rounded" width="70" heigth="70">
                        </td>
                        <td>
                            <button class="avatar btn btn-info" title="Cambiar logo del laboratorio" type="button" data-toggle="modal" data-target="#cambio-logo">
                                <i class="far fa-image"></i>
                            </button>

                            <button class="editar btn btn-success" title="Editar el laboratorio" type="button" data-toggle="modal" data-target="#crearlaboratorio">
                                <i class="fas fa-pencil-alt"></i>
                            </button>

                            <button class="borrar btn btn-danger" title="Eliminar el laboratorio">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    
                `;
            });
           $('#laboratorios').html(template);
       })
   }
   //evento del input de busqueda de laboratorio//
   $(document).on('keyup','#buscar-laboratorio',function(){
       let valor=$(this).val();
       if(valor!=''){
            buscar_laboratorio(valor);
       }else{
            buscar_laboratorio();
       }
   })
   //abrir el modal de cambiar avatar//
   $(document).on('click','.avatar',(e)=>{
        funcion="cambiar_logo";
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        //console.log(elemento);
        const id=$('elemento').attr('labId'); 
        const nombre=$('elemento').attr('labNom'); ; 
        const avatar=$('elemento').attr('labAvatar');
        //console.log(id+nombre+avatar);
        $('#logo-actual').attr('src',avatar);
        $('#nombre_logo').html(nombre);
        $('#funcion').val(funcion);  
        $('#id_logo-lab').val(id);
   })
   $('#form-logo').submit(e=>{
        let formData=new FormData($('#form-logo')[0]);
        $.ajax({
            url:'../controlador/controlador-laboratorio.php',
            type:'POST',
            data:formData,
            cache:false,
            processData:false,
            contentType:false
        }).done(function(response){
            //console.log(response);
            const json=JSON.parse(response);
            if (json.alert=='editado') {
                $('#logo-actual').attr('src',json.ruta);
                $('#form-logo').trigger('reset');
                $('#update').hide('slow');
                $('#update').show(1000);
                $('#update').hide(2000);
                buscar_laboratorio();
            }else{
                $('#no-update').hide('slow');
                $('#no-update').show(1000);
                $('#no-update').hide(2000);
                $('#form-logo').trigger('reset');    
            }
        });
        e.preventDefault();
    })
    //borrar el laboratorio
    $(document).on('click','.borrar',(e)=>{
        funcion="borrar";
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        //console.log(elemento);
        const id=$('elemento').attr('labId'); 
        const nombre=$('elemento').attr('labNom'); ; 
        const avatar=$('elemento').attr('labAvatar');
        //console.log(id+nombre+avatar);
        //libreria sweetalert//
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Desea eliminar al laboratorio: '+nombre+'?',
            text: "No se podra revertir la acción!",
            //icon: 'warning',
            // añadimos propiedades para mostrar el avatar del laboratorio//
            imageUrl:''+avatar+'',
            imageWidth:100,
            imageHeigth:100,
            showCancelButton: true,
            confirmButtonText: 'Si, se elimino el registro!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                //eviamos datos mediante ajax//
                $.post('../controlador/controlador-laboratorio.php',{id,funcion},(response)=>{
                    //console.log(response);
                    editar==false;
                    if (response=='borrado') {
                            swalWithBootstrapButtons.fire(
                                'Eliminado!',
                                'El laboratorio :'+nombre+' se ha eliminado',
                                'success'
                            )
                            buscar_laboratorio();
                    }else{
                        swalWithBootstrapButtons.fire(
                            'No se pudo Eliminar!',
                            'El laboratorio :'+nombre+' nose ha eliminado porque esta asociado a un producto',
                            'success'
                          )
                    }
                })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                'Cancelar',
                'El laboratorio :'+nombre+' no se elimino',
                'error'
              )
            }
          })
   })
   //editar el laboratorio//
   $(document).on('click','.editar',(e)=>{
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        //console.log(elemento);
        const id=$('elemento').attr('labId'); 
        const nombre=$('elemento').attr('labNom'); ; 
        //console.log(id+nombre+avatar);
        $('#id_editar_lab').val(id);
        $('#nombre-laboratorio').val(nombre);
        editar=true;
    })
});