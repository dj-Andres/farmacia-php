$(document).ready(function(){
    var tipo_usuario=$('#tipo_usuario').val();
    //console.log(tipo_usuario);
    if(tipo_usuario==2){
        $('#boton-crear').hide();
    }
    buscar_datos();
    var funcion;
    function buscar_datos(sql) {
        funcion='buscar_usuarios_adm';
        $.post('../controlador/usuario-controlador.php',{sql,funcion},(response)=>{
            //console.log(response);
            const usuarios=JSON.parse(response);
            let templete='';
            usuarios.forEach(usuario => {
                templete+=`
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                        <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            ${usuario.tipo_usuario}                            
                        </font></font></div>
                        <div class="card-body pt-0">
                            <div class="row">
                            <div class="col-7">
                                <h2 class="lead"><b><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${usuario.nombre} ${usuario.apellido}</font></font></b></h2>
                                <p class="text-muted text-sm"><b><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Acerca de:</font></font></b><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ${usuario.adicional}</font></font></p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Cedula: ${usuario.cedula}</font></font></li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Edad: ${usuario.edad}</font></font></li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Correo: ${usuario.correo}</font></font></li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Dirección: ${usuario.residencia}</font></font></li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Teléfono: ${usuario.telefono}</font></font></li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                <img src="${usuario.avatar}" alt="" class="img-circle img-fluid">
                            </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">`;
                            if (tipo_usuario==3) {
                                if(usuario.tipo_us!=3){
                                    //concateno variables//
                                    templete+=`
                                    <button class="btn btn-danger mr-1">
                                        <i class"fas fa-window-close mr-1"></i>Eliminar
                                    </button>
                                    `;                                    
                                }
                                if(usuario.tipo_us==2){
                                    templete+=`
                                    <button class="btn btn-primary ml-1">
                                        <i class"fas fa-window-close mr-1"></i>Ascender
                                    </button>
                                    `;                                    
                                }
                            }else{
                                if(tipo_usuario==1 && usuario.tipo_us!=1 && usuario.tipo_us!=3){
                                    templete+=`
                                    <button class="btn btn-danger">
                                        <i class"fas fa-window-close mr-1"></i>Eliminar
                                    </button>
                                    `;                                    
                                }

                            }
                            templete+=` 
                            </div>
                        </div>
                        </div>
                    </div>
                `;
            })
            $('#usuarios').html(templete);
        });
    }
    $(document).on('keyup','#buscar',function(){
        let valor=$(this).val();
        if(valor !=""){
            buscar_datos(valor);
        }else{
            buscar_datos();
        }
    });
    $('#form-crear').submit(e=>{
        let nombre=$('#nombre').val();
        let apellido=$('#apellido').val();
        let nacimiento=$('#nacimiento').val();
        let cedula=$('#cedula').val();
        let clave=$('#clave').val();
        funcion='crear-usuario';
        $.post('../controlador/usuario-controlador.php'{nombre,apellido,nacimiento,cedula,clave,funcion},(response)=>{
            console.log(response);
            if(response==crear){
                $('#crear').hide('slow');
                $('#crear').show(1000);
                $('#crear').hide(2000);
                $('#form-crear').trigger('reset');
                buscar_datos();
            }else{
                $('#nocrear').hide('slow');
                $('#nocrear').show(1000);
                $('#nocrear').hide(2000);
                $('#form-crear').trigger('reset');
            }
        });
        e.preventDefault();
    });
})