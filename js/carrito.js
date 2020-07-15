$(document).ready(function(){
    calcularTotal();
    contar_productos();
    recuperar_carrito_Ls_compra();
    recuperar_carrito_Ls();
    $(document).on('click','.agg-carrito',(e)=>{
        const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id=$(elemento).attr('prodID');
        const nombre=$(elemento).attr('prodNom');
        const concentracion=$(elemento).attr('prodConcentracion');
        const adicioanl=$(elemento).attr('prodAdicional');
        const precio=$(elemento).attr('prodPrecio');
        const laboratorio=$(elemento).attr('prodLaboratorio');
        const tipo=$(elemento).attr('prodTipo');
        const presentacion=$(elemento).attr('prodPresentacion');
        const avatar=$(elemento).attr('prodAvatar');
        const stock=$(elemento).attr('prodStock');

            const producto={
                id:id,
                nombre:nombre,
                concentracion:concentracion,
                adicioanl:adicioanl,
                precio:precio,
                laboratorio:laboratorio,
                tipo:tipo,
                presentacion:presentacion,
                avatar:avatar,
                stock:stock,
                cantidad:1
            }
            let Id_producto;
            let productos;
            productos=recuperarLs();
            productos.forEach(prod => {
                if(prod.id===producto.id){
                    Id_producto=prod.id
                }
            });
            if(Id_producto===producto.id){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El producto ya se añadio!'
                  })
            }else{
                template=`
                        <tr prodId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td>${producto.concentracion}</td>
                            <td>${producto.adicional}</td>
                            <td>${producto.precio}</td>
                            <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                        </tr>
                    `;
                $('#lista').append(template);
                AggLs(producto);
                //let contador;
                contar_productos();
                //console.log(contador);
            }
    })
    $(document).on('click','.borrar-producto',(e)=>{
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const Id=$(elemento).attr('prodId');
        elemento.remove();
        elmininar_producto_ls(id);
        contar_productos();
        calcularTotal();
        //console.log(contador);
    })
    $(document).on('click','#vaciar-carrito',(e)=>{
        $('#lista').empty();
        eliminar_ls();
        contar_productos();
        //console.log(contador);
    })
    //funcion para la venta del producto//
    $(document).on('click','#procesar_pedido',(e)=>{
        procesar_pedido();
    })
    $(document).on('click','#procesar_compra',(e)=>{
        procesar_compra();
    })
    function recuperarLs(){
        let productos;
        if(localStorage.getItem('productos')===null){
            productos=[];
        }else{
            productos=JSON.parse(localStorage.getItem('productos'));
        }
        return productos
    }
    function AggLs(producto){
        let productos;
        productos=recuperarLs();
        //push para agg mas filas al array//
        productos.push(producto);
        localStorage.setItem('productos',JSON.stringify(productos));
    }
    function recuperar_carrito_Ls() {
        let productos,Id_producto;
        productos=recuperarLs();
        funcion="buscar_Id";
        productos.forEach(producto => {
            Id_producto=producto.id;
            $.post('../controlador/controlador-producto.php',{funcion,Id_producto},(response)=>{
                let template_carrito='';
                let json=JSON.parse(response);
                template_carrito=`
                    <tr prodId="${json.id}>
                        <td>${json.id}</td>
                        <td>${json.nombre}</td>
                        <td>${json.concentracion}</td>
                        <td>${json.adicional}</td>
                        <td>${json.precio}</td>
                        <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                    </tr>    
                `;
                $('#lista').append(template_carrito);          
            })
        });      
    }
    function elmininar_producto_ls(Id){
        let productos;
        productos=recuperarLs();
        productos.forEach(function(producto,indice) {
            if(producto.id===Id){
                //eliminar elementos mediante el indice su usa splice//
                productos.splice(indice,1);
            }
        });
        localStorage.setItem('productos',JSON.stringify(productos));
    }
    function eliminar_ls(){
        localStorage.clear();
    }
    //funcion para colocar un contador de productos al carrito//
    function contar_productos(){
        let productos;
        let contador=0;
        productos=recuperarLs();
        productos.forEach(producto => {
            contador++;
        });
        $('#contador').html(contador);
    }
    function procesar_pedido() {
        let productos;
        productos=recuperarLs();
        if(productos.length === 0){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No existe el producto añadido al carrito!'
            })          
        }else{
            location.href='../vista/adm_compra.php';
        }
    }
    function recuperar_carrito_Ls_compra() {
        let productos,Id_producto;
        productos=recuperarLs();
        funcion="buscar_Id";
        productos.forEach(producto => {
            Id_producto=producto.id;
            $.post('../controlador/controlador-producto.php',{funcion,Id_producto},(response)=>{
                let template_compra='';
                let json=JSON.parse(response);
                template_compra=`
                    <tr prodId="${producto.id} prodPrecio="${json.precio}">
                        <td>${json.nombre}</td>
                        <td>${json.stock}</td>
                        <td class="precio">${json.precio}</td>
                        <td>${json.concentracion}</td>
                        <td>${json.adicional}</td>
                        <td>${json.laboratorio}</td>
                        <td>${json.presentacion}</td>
                        <td>
                            <input type="number" min="1" class="form-control cantidad-producto" value="${producto.cantidad }">
                        </td>
                        <td class="subtotal">
                            <h5>${json.precio*producto.cantidad}</h5>
                        </td>
                        <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                    </tr>
                `;
                $('#lista-compra').append(template_compra);          
            })
        });      
    }
    //actualizar precios y cantidad/7
    $(document).on('click','#actualizar',(e)=>{
        let productos,precios;
        precios=document.querySelectorAll('.precio');
        productos=recuperarLs();
        productos.forEach(function(productos,indice) {
            producto.precio=precios[indice].textContent;
        });
        localStorage.setItem('productos',JSON.stringify(productos));
        calcularTotal();
    })
    //evento de actualizar en tiempo real la cantidad de compra//
    $("#cp").keyup((e)=>{
        let id,cantidad,producto,productos,montos,precio;
         producto=$(this)[0].activeElement.parentElement.parentElement;
         id=$(producto).attr('prodId');
         precio=$(producto).attr('prodPrecio');
         cantidad=producto.querySelector('input').value;
         montos=document.querySelectorAll('subtotal');
         productos=recuperarLs();
         
         productos.forEach(function(prod,indice) {
             if(prod.id===id){
                prod.cantidad=cantidad;
                prod.precio=precio;
                montos[indice].innerHTML=`<h5>${cantidad*precio}</h5>`;
             }
         });
         localStorage.setItem('productos',JSON.stringify(productos));
         calcularTotal();
    })
    function calcularTotal(){
        let productos;
        let subtotal;
        let subt_igv;
        let total_sin_descuento;
        let pago;
        let vuelto;
        let descuento;
        let total=0;
        let igv=0.12;
        productos=recuperarLs();

        productos.forEach(producto => {
            let subtotal_prod=Number(producto.precio*producto.cantidad);
            total=total+subtotal_prod;
        });
        total_sin_descuento=total.toFixed(2);
        subt_igv=parseFloat(total*igv).toFixed(2);
        subtotal=parseFloat(total-subt_igv).toFixed(2);

        pago=$('#pago').val();
        descuento=$('#descuento').val();

        total=total-descuento;
        vuelto=pago-total;

        $('#subtotal').html(subtotal);
        $('#con_igv').html(subt_igv);
        $('#total_sin_descuento').html(total_sin_descuento);
        $('#total').html(total).toFixed(2);
        $('#vuelto').html(vuelto).toFixed(2);

    }
    function procesar_compra(){
        let nombre,cedula;
        nombre=$('#cliente').val();
        cedula=$('#cedula').val();

        if(recuperarLs.length==0){
            registrar_compra(nombre_cli,cedula);


            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No hay productos en el carrito de compras!'
              }).then(function() {
                  location.href="../vista/adm_catalogo.php"
              })
        }
        else if(nombre== ""){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresar el nombre del cliente!'
              })
        }
        else{
            verificar_stock().then(error=>{
                if(error==0){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Se realizo la compra',
                        showConfirmButton: false,
                        timer: 1500
                      }).then(function() {
                        eliminar_ls();
                        location.href="../vista/adm_catalogo.php"
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El numero de de producto es superior al que se encuentra en el stock!'
                      })
                }
            });
        }
    }

    async function verificar_stock(){
        let productos;
        let error=0;
        funcion='verificar_stock';
        productos=recuperarLs();
        const response=await fetch('../controlador/controlador-producto.php',{
            method :'POST',
            headers:{'Content=Type':'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&productos='+JSON.stringify(productos)
        })
        let error=await response.text();
        
        return error; 
    }
    function registrar_compra(nombre_cli,cedula){
        funcion='registrar_compra';
        let total=$('#total').get(0).textContent;
        let productos=recuperarLs();
        let json=JSON.stringify(productos);
        $.post('../controlador/controlador-compra.php',{funcion,total,nombre_cli,cedula,json},(response)=>{
            console.log(response);
        })
    }
})