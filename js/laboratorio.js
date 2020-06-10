$(document).ready(function(){
    buscar_laboratorio();
    var funcion;
    //creacion de evento submit del modal de laboratorio//
   $('#form-crear-laboratorio').submit(e=>{
        let nombre_laboratorio=$('#nombre-laboratorio').val();
        funcion='crear';
        //funcion ajax estilo post//
        $.post('../controlador/controlador-laboratorio.php',{nombre_laboratorio,funcion},(response)=>{
            //console.log(response);
            if(response=='crear'){
                $('#crear-laboratorio').hide('slow');
                $('#crear-laboratorio').show(1000);
                $('#crear-laboratorio').hide(2000);
                $('#form-crear-laboratorio').trigger('reset');
                buscar_laboratorio();
            }else{
                $('#nocrear-laboratorio').hide('slow');
                $('#nocrear-laboratorio').show(1000);
                $('#nocrear-laboratorio').hide(2000);
                $('#form-crear-laboratorio').trigger('reset');
            }   
        })
        e.preventDefault();
   });
   function buscar_laboratorio(consulta){
       funcion='buscar';
       $.post('../controlador/controlador-laboratorio.php',{consulta,funcion},(response)=>{
           console.log(response);
           
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
});