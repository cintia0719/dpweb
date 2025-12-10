let productos_venta = {};

let id = 2;
let id2 = 4;

let producto = {};
producto.nombre = "Producto A";
producto.precio = 100;
producto.cantidad = 2;
//producto_venta.push(producto);
productos_venta[id]=producto;
console.log(productos_venta);

let producto2 = {};
producto.nombre = "Producto B";
producto.precio = 100;
producto.cantidad = 2;
//producto_venta.push(producto2);
productos_venta[id2]=producto2;
console.log(productos_venta);

console.log(productos_venta);

async function agregar_producto_temporal() {
    let id = document.getElementById('id_producto_venta').value;
    let precio = document.getElementById('producto_precio_venta').value;
    let cantidad = document.getElementById('producto_cantidad_venta').value;
    const datos = new FormData();
    datos.append('id_producto', id);
    datos.append('precio', precio);
    datos.append('cantidad', cantidad);
    try {
        let respuesta = await fetch(base_url +  'control/VentaController.php?tipo=registrarTemporal',
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        body: datos,
      }
    );
    json = await respuesta.json();
    if (json.msg == "registrado") {
        alert("el producto fue registrado");
    }else{
        alert("el producto fue actualizado");
    }
    
    } catch (error) {
        console.log("error en agregar producto temporal" + error);
    }
}


document.addEventListener('DOMContentLoaded', actualizarCarrito);



async function eliminar_temporal(id) {

    const datos = new FormData();
    datos.append('id', id);

    let res = await fetch(base_url + 'control/ventaController.php?tipo=eliminar', {
        method: 'POST',
        body: datos
    });

    let json = await res.json();

    if (json.status) {
        actualizarCarrito();
        Swal.fire({ icon: "success", title: "Producto eliminado" })

    } else {
        Swal.fire({ icon: "error", title: "Error al eliminar" })
    }
    //await actualizarCarrito();
}

async function actualizarCarrito() {
    try {
        let res = await fetch(base_url + 'control/ventaController.php?tipo=listarTemporal');
        let json = await res.json();

        if (json.status) {

            let rows = "";
            let subtotalGeneral = 0;

            json.data.forEach(p => {

                let subtotal = p.precio * p.cantidad;
                subtotalGeneral += subtotal;

                rows += `
                <tr>
                    <td>${p.nombre}</td>
                    <td>${p.cantidad}</td>
                    <td>${p.precio}</td>
                    <td>${subtotal.toFixed(2)}</td>
                    <td>
                        <button onclick="eliminar_temporal(${p.id})" class="btn btn-danger btn-sm">
    Eliminar
</button>

                    </td>
                </tr>`;
            });

            // Insertamos en la tabla
            document.getElementById("tablaCarrito").innerHTML = rows;

            // Cálculos finales
            let igv = subtotalGeneral * 0.18;
            let totalFinal = subtotalGeneral + igv;

            document.getElementById("subtotal_final").textContent = subtotalGeneral.toFixed(2);
            document.getElementById("igv_final").textContent = igv.toFixed(2);
            document.getElementById("total_final").textContent = totalFinal.toFixed(2);

        }
    } catch (error) {
        console.log(error);
    }
}

document.addEventListener('DOMContentLoaded', actualizarCarrito);

