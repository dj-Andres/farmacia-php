$(document).ready(function(){
    buscar_presentacion();
    var funcion;
    var editar=false;
    //creacion de evento submit del modal de laboratorio//
   $('#form-crear-presentacion').submit(e=>{
        let nombre_presentacion=$('#nombre-presentacion').val();
        let id_editado=$('#Id_editar_presentacion').val();
        if (editar==false) {
            funcion='crear';
        }else{
            funcion='actualizar';
        }
        //funcion ajax estilo post//
        $.post('../controlador/controlador-presentacion.php',{nombre_presentacion,id_editado,funcion},(response)=>{
            //console.log(response);
            if(response=='crear'){
                $('#crear-presentacion').hide('slow');
                $('#crear-presentacion').show(1000);
                $('#crear-presentacion').hide(2000);
                $('#form-crear-presentacion').trigger('reset');
                buscar_presentacion();
            }
            if(response=='nocrear'){
                $('#nocrear-presentacion').hide('slow');
                $('#nocrear-presentacion').show(1000);
                $('#nocrear-presentacion').hide(2000);
                $('#form-crear-presentacion').trigger('reset');
            }
            if(response=='editado'){
                $('#crear-presentacion-edit').hide('slow');
                $('#crear-presentacion-edit').show(1000);
                $('#crear-presentacion-edit').hide(2000);
                $('#form-crear-presentacion').trigger('reset');
                buscar_presentacion();
            }
            editar==false;
        })
        e.preventDefault();
   });
   function buscar_presentacion(consulta){
       funcion='buscar';
       $.post('../controlador/controlador-presentacion.php',{consulta,funcion},(response)=>{
           //console.log(response);
            const presentaciones=JSON.parse(response);
            let template='';
            presentaciones.forEach(presentacion => {
                template+=`
                    <tr presentacionId="${presentacion.Id_presentacion}" presentacionNom="${presentacion.nombre}">
                        <td>${presentacion.nombre}</td>
                        <td>
                            <button class="editar-presentacion btn btn-success" title="Editar el laboratorio" type="button" data-toggle="modal" data-target="#creartipo">
                                <i class="fas fa-pencil-alt"></i>
                            </button>

                            <button class="borrar-presentacion btn btn-danger" title="Eliminar el laboratorio">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
           $('#tipos').html(template);
       })
   }
   //evento del input de busqueda de laboratorio//
   $(document).on('keyup','#buscar-presentacion',function(){
       let valor=$(this).val();
       if(valor!=''){
            buscar_presentacion(valor);
       }else{
            buscar_presentacion();
       }
   })
    //borrar el laboratorio
    $(document).on('click','.borrar-presentacion',(e)=>{
        funcion="borrar";
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        //console.log(elemento);
        const id=$('elemento').attr('presentacionId'); 
        const nombre=$('elemento').attr('presentacionNom'); ; 
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
            title: 'Desea eliminar la presentación del producto: '+nombre+'?',
            text: "No se podra revertir la acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, se elimino el registro!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                //eviamos datos mediante ajax//
                $.post('../controlador/controlador-presentacion.php',{id,funcion},(response)=>{
                    //console.log(response);
                    editar==false;
                    if (response=='borrado') {
                            swalWithBootstrapButtons.fire(
                                'Eliminado!',
                                'La presentación :'+nombre+' se ha eliminado',
                                'success'
                            )
                            buscar_presentacion();
                    }else{
                        swalWithBootstrapButtons.fire(
                            'No se pudo eliminar la presentación!',
                            'La presentación :'+nombre+' nose ha eliminado porque esta asociado a un producto',
                            'success'
                          )
                    }
                })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                'Cancelar',
                'La presentación :'+nombre+' no se elimino',
                'error'
              )
            }
          })
   })
   //editar el laboratorio//
   $(document).on('click','.editar-presentacion',(e)=>{
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        //console.log(elemento);
        const id=$('elemento').attr('presentacionId'); 
        const nombre=$('elemento').attr('presentacionNom'); ; 
        //console.log(id+nombre+avatar);
        $('#Id_editar_presentacion').val(id);
        $('#nombre-presentacion').val(nombre);
        editar=true;
    })
});