$(document).ready(function(){
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
                    <tr prodId="${producto.id}>
                        <td>${json.nombre}</td>
                        <td>${json.stock}</td>
                        <td>${json.precio}</td>
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
    //evento de actualizar en tiempo real la cantidad de compra/7
    $("#cp").keyup((e)=>{
        let id,cantidad,producto,productos,montos;
         producto=$(this)[0].activeElement.parentElement.parentElement;
         id=$(producto).attr('prodId');
         cantidad=producto.querySelector('input').value;
         montos=document.querySelectorAll('subtotal');
         productos=recuperarLs();
         
         productos.forEach(function(prod,indice) {
             if(prod.id===id){
                prod.cantidad=cantidad;
                montos[indice].innerHTML=`<h5>${cantidad*productos[indice].precio}</h5>`;
             }
         });
         localStorage.setItem('productos',JSON.stringify(producto));
    })
})