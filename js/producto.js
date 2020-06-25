$(document).ready(function(){
    var funcion;
    var editar=false;
    buscar_producto();
    //uso de la libreria select2//
    $('.select2').select2();
    rellenar_laboratorios();
    rellenar_presentacion();
    rellenar_proveedor();
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
    function rellenar_proveedor() {
        funcion="rellenar_proveedores";
        $.post('../controlador/controlador-proveedor.php',{funcion},(response)=>{
            //console.log(response);
            const laboratorios=JSON.parse(response);
            let template='';
            proveedores.forEach(proveedor => {
                template+=`
                    <option value="${provvedor.Id_proveedor}">${proveedor.nombre}</option>
                `;
            });
            $('#proveedor').html(template);
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
        let id=$('#id_editar_producto').val();
        let nombre=$('#nombre_producto').val();
        let concentracion=$('#concentracion').val();
        let adicional=$('#adicional').val();
        let precio=$('#precio').val();
        let laboratorio=$('#laboratorio').val();
        let tipo=$('#tipo_producto').val();
        let presentacion=$('#presentacion').val();
        //console.log(nombre+" "+concentracion);
        if(editar==true){
            funcion='editar';
        }else{
            funcion='crear';
        }
        $.post('../controlador/controlador-producto.php',{funcion,id,nombre,concentracion,adicional,precio,laboratorio,tipo,presentacion},(response)=>{
            //console.log(response);
            if(response=='crear'){
                $('#crear').hide('slow');
                $('#crear').show(1000);
                $('#crear').hide(2000);
                $('#form-crear-prodcuto').trigger('reset');
                buscar_producto();
            }
            if(response=='editado'){
                $('#editar').hide('slow');
                $('#editar').show(1000);
                $('#editar').hide(2000);
                $('#form-crear-prodcuto').trigger('reset');
                buscar_producto();
            }
            if(response=='nocrear'){
                $('#nocrear').hide('slow');
                $('#nocrear').show(1000);
                $('#nocrear').hide(2000);
                $('#form-crear-prodcuto').trigger('reset');
            }
            if(response=='noeditado'){
                $('#nocrear').hide('slow');
                $('#nocrear').show(1000);
                $('#nocrear').hide(2000);
                $('#form-crear-prodcuto').trigger('reset');
            }
            editar=false;
        })
        e.PreventDefault(); 
    });
    //listar producto//
    function buscar_producto(consulta){
        funcion='buscar';
        $.post('../controlador/controlador-producto.php',{consulta,funcion},(response)=>{
            //console.log(response);
            const productos=JSON.parse(response);
            let templete='';
            productos.forEach(producto => {
                templete+=`
                        <div prodID="${producto.Id_producto}" prodNom="${producto.nombre}" prodPrecio="${producto.precio}"  prodConcentracion="${producto.concentracion}" prodAdicional="${producto.adicional}" prodAvatar="${producto.avatar}" prodTipo="${producto.Id_tipo}" prodPresentacion="${producto.Id_presentacion}" prodLaboratorio="${producto.Id_laboratorio}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                        <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                        </font></font></div>
                        <div class="card-body pt-0">
                            <div class="row">
                            <div class="col-7">
                                <h2 class="lead"><b>${producto.nombre}</b></h2>
                                <h4 class="lead"><b><i class="fas fa-lg fa-dollar-sign mr-1"></i>${producto.precio}</b></h4>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle "></i></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Concentración: ${producto.concentracion}</font></font></li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Adicional:${producto.adicional}</font></font></li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Laboratorio:${producto.laboratorio}</font></font></li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyrigth"></i></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Tipo:${producto.tipo}</font></font></li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Presentación:${producto.presentacion}</font></font></li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                <img src="${producto.avatar}" alt="" class="img-circle img-fluid">
                            </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <button  class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambio-logo">
                                    <i class="fas fa-image"></i>
                                </button>
                                <button class="editar btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#crear-producto">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="lote btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#crear-lotes">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button class="borrar btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                        </div>
                    </div>
                `;
            });
            $('#productos').html(templete);
        })
    }
    //funcion de busqueda en el input//
    $(document).on('keyup','#buscar-producto',function(){
        let valor=$(this).val();
        if(valor!=''){
             buscar_producto(valor);
        }else{
             buscar_producto();
        }
    })
    $(document).on('click','.avatar',(e)=>{
        const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id=$(elemento).attr('prodID');
        const nombre=$(elemento).attr('prodNom');
        //console.log(id+''+avatar);
        $('#id_editar_lote').val(id);
        $('#producto').html(nombre);
    });
    //agregar #lote a productos//
    $(document).on('click','.lote',(e)=>{
        funcion="cambiar_avatar";
        const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id=$(elemento).attr('prodID');
        const avatar=$(elemento).attr('prodAvatar');
        const nombre=$(elemento).attr('prodNom');
        //console.log(id+''+avatar);
        $('#funcion').val(funcion);
        $('#id_logo_prod').val(id);
        $('#avatar').val(avatar);
        $('#logo-actual').attr('src',avatar);
        $('#nombre_logo').html(nombre);
    });
    $('#form-logo').submit(e=>{
        let  formData=new FormData($('#form-logo')[0]);
        $.ajax({
            url:'../controlador/controlador-producto.php',
            type:'POST',
            data:formData,
            cache:false,
            processData:false,
            comentType:false
        }).done(function(response){
            //console.log(response);
            const json=JSON.parse(response);
            if (json.alert=='editado') {
                $('#logo-actual').attr('src',json.ruta);
                $('#update').hide('slow');
                $('#update').show(1000);
                $('#update').hide(2000);
                $('#form-logo').trigger('reset');
                buscar_producto();
            }else{
                $('#no-update').hide('slow');
                $('#no-update').show(1000);
                $('#no-update').hide(2000);
                $('#form-logo').trigger('reset');    
            }
        });
        e.PreventDefault();
    });
    $(document).on('click','.editar',(e)=>{
        //funcion="cambiar_avatar";
        const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id=$(elemento).attr('prodID');
        const nombre=$(elemento).attr('prodNom');
        const concentracion=$(elemento).attr('prodConcentracion');
        const adicioanl=$(elemento).attr('prodAdicional');
        const precio=$(elemento).attr('prodPrecio');
        const laboratorio=$(elemento).attr('prodLaboratorio');
        const tipo=$(elemento).attr('prodTipo');
        const presentacion=$(elemento).attr('prodPresentacion');
        //console.log(id+''+avatar);
        $('#id_editar_producto').val(id);
        $('#nombre_producto').val(nombre);
        $('#concentracion').val(concentracion);
        $('#adicional').val(adicioanl);
        $('#precio').val(precio);
        $('#laboratorio').val(laboratorio).trigger('change');
        $('#tipo_producto').val(tipo).trigger('change');
        $('#presentacion').val(presentacion).trigger('change');
        editar=true;
    });
    //borrar producto//
    $(document).on('click','.borrar',(e)=>{
        funcion="borrar";
        const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        //console.log(elemento);
        const id=$('elemento').attr('prodId'); 
        const nombre=$('elemento').attr('prodNom'); ; 
        const avatar=$('elemento').attr('prodAvatar');
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
                $.post('../controlador/controlador-producto.php',{id,funcion},(response)=>{
                    //console.log(response);
                    editar==false;
                    if (response=='borrado') {
                            swalWithBootstrapButtons.fire(
                                'Eliminado!',
                                'El producto :'+nombre+' se ha eliminado',
                                'success'
                            )
                            buscar_producto();
                    }else{
                        swalWithBootstrapButtons.fire(
                            'No se pudo Eliminar!',
                            'El producto :'+nombre+' nose ha eliminado porque esta asociado a un producto',
                            'success'
                          )
                    }
                })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                'Cancelar',
                'El producto :'+nombre+' no se elimino',
                'error'
              )
            }
          })
   })
   $('#form-crear-lote').submit(e=>{
        let id_producto=$('#id_editar_lote').val();
        let proveedor=$('#proveedor').val();
        let stock=$('#stock').val();
        let vencimiento=$('#vencimiento').val();
        funcion="crear_lote";
        $.post('../controlador/controlador-lote.php',{funcion,id_producto,proveedor,stock,vencimiento},(response)=>{
            if(response=='crear'){
                $('#add').hide('slow');
                $('#add').show(1000);
                $('#add').hide(2000);
                $('#form-crear-lote').trigger('reset');
                buscar_producto();              
            }
        })
        e.PreventDefault();
   });
})