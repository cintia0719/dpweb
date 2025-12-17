// Limpia datos de ejemplo y define helpers reales para ventas
let productos_venta = {};
let id = 2;
let id2 = 4;
let producto = {};
producto.nombre = "Producto A";
producto.precio = 100;
producto.cantidad = 2;

let producto2 = {};
producto2.nombre = "Producto B";
producto2.precio = 200;
producto2.cantidad = 1;
//productos_venta.push(producto);

productos_venta[id] = producto;
productos_venta[id2] = producto2;
console.log(productos_venta);

// Renderiza tarjetas de productos en el panel de búsqueda y setea inputs ocultos
async function listar_productos_venta() {
    try {
        let dato = '';
        const input = document.getElementById('busqueda_venta');
        if (input) dato = input.value;
        const datos = new FormData();
        datos.append('dato', dato);
        let respuesta = await fetch(base_url + 'control/productosController.php?tipo=buscar_producto_venta', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let json = await respuesta.json();
        let html = '';
        if (json.status && Array.isArray(json.data) && json.data.length > 0) {
            json.data.forEach(producto => {
                const imgSrc = producto.imagen ? (base_url + producto.imagen) : (base_url + 'uploads/productos/no-image.png');
                html += `
                    <div class="card m-2 col-12 col-sm-6 col-md-3">
                        <div class="card-body p-2">
                            <img src="${imgSrc}" alt="${producto.nombre || ''}" width="100%" height="120" style="object-fit:cover;"/>
                            <p class="card-text mb-1 text-truncate" title="${producto.nombre || ''}">${producto.nombre || ''}</p>
                            <small class="text-muted">S/. ${producto.precio || '0.00'}</small>
                            <div class="d-grid mt-2">
                                <button class="btn btn-primary btn-sm" onclick="agregar_producto_temporal(${producto.id}, ${producto.precio || 0}, 1)">Agregar</button>
                            </div>
                        </div>
                    </div>`;
            });
        } else {
            html = '<div class="col-12"><div class="alert alert-info">No hay productos</div></div>';
        }
        const cont = document.getElementById('productos_venta');
        if (cont) cont.innerHTML = html;
    } catch (error) {
        console.error('Error al listar productos para venta:', error);
    }
}

async function agregar_producto_temporal(id_product = 0, price = 0, cant = 1) {
    let id, precio, cantidad;
    if (!id_product) {
        id = document.getElementById('id_producto_venta')?.value;
    } else {
        id = id_product;
    }
    if (!price) {
        precio = document.getElementById('producto_precio_venta')?.value;
    } else {
        precio = price;
    }
    if (!cant) {
        cantidad = document.getElementById('producto_cantidad_venta')?.value || 1;
    } else {
        cantidad = cant;
    }
    if (!id || !precio) return;

    const datos = new FormData();
    datos.append('id_producto', id);
    datos.append('precio', precio);
    datos.append('cantidad', cantidad);
    try {
        let respuesta = await fetch(base_url + 'control/VentaController.php?tipo=registrarTemporal', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        const json = await respuesta.json();
        if (json.status) {
            Swal.fire({
                icon: 'success',
                title: 'Producto agregado',
                text: json.msg === 'actualizado' ? 'Cantidad actualizada' : 'Agregado a la lista de compra',
                timer: 1200,
                showConfirmButton: false
            });
        }
        await listar_temporales();
    } catch (error) {
        console.log('error en agregar producto temporal ' + error);
    }
}
async function listar_temporales() {
    try {
        let respuesta = await fetch(base_url + 'control/VentaController.php?tipo=listar_venta_temporal', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        json = await respuesta.json();
        if (json.status) {
            let lista_temporal = '';
            json.data.forEach(t_venta => {
                lista_temporal += `<tr>
                                    <td>${t_venta.nombre}</td>
                                    <td><input type="number" id="cant_${t_venta.id}" value="${t_venta.cantidad}" style="width: 60px;" onkeyup="actualizar_subtotal(${t_venta.id}, ${t_venta.precio});" onchange="actualizar_subtotal(${t_venta.id}, ${t_venta.precio});"></td>
                                    <td>S/. ${t_venta.precio}</td>
                                    <td id="subtotal_${t_venta.id}">S/. ${t_venta.cantidad * t_venta.precio}</td>
                                    <td><button class="btn btn-danger btn-sm" onclick="eliminarTemporal(${t_venta.id})">Eliminar</button></td>
                                </tr>`
            });
            document.getElementById('lista_compra').innerHTML = lista_temporal;
            act_subt_general();
        }
    } catch (error) {
        console.log("error al cargar productos temporales " + error);
    }
}
async function actualizar_subtotal(id, precio) {
    let cantidad = document.getElementById('cant_' + id).value;
    try {
        const datos = new FormData();
        datos.append('id', id);
        datos.append('cantidad', cantidad);
        let respuesta = await fetch(base_url + 'control/VentaController.php?tipo=actualizar_cantidad', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            subtotal = cantidad * precio;
            document.getElementById('subtotal_' + id).innerHTML = 'S/. ' + subtotal;
            act_subt_general();
        }
    } catch (error) {
        console.log("error al actualizar cantidad : " + error);
    }
}

async function eliminarTemporal(id) {
    const confirm = await Swal.fire({
        icon: 'warning',
        title: '¿Eliminar producto?',
        text: 'Esta acción no se puede deshacer',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6'
    });
    if (!confirm.isConfirmed) return;
    try {
        const datos = new FormData();
        datos.append('id', id);
        let respuesta = await fetch(base_url + 'control/VentaController.php?tipo=eliminar_temporal', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        const json = await respuesta.json();
        if (json.status) {
            await listar_temporales();
        }
    } catch (error) {
        console.log('error al eliminar temporal: ' + error);
    }
}

async function act_subt_general() {
    try {
        let respuesta = await fetch(base_url + 'control/VentaController.php?tipo=listar_venta_temporal', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        json = await respuesta.json();
        if (json.status) {
            subtotal_general = 0;
            json.data.forEach(t_venta => {
                subtotal_general += parseFloat(t_venta.precio * t_venta.cantidad);
            });
            igv = parseFloat(subtotal_general * 0.18).toFixed(2);
            total = (parseFloat(subtotal_general) + parseFloat(igv)).toFixed(2);
            document.getElementById('subtotal_general').innerHTML = 'S/. ' + subtotal_general.toFixed(2);
            document.getElementById('igv_general').innerHTML = 'S/. ' + igv;
            document.getElementById('total').innerHTML = 'S/. ' + total;
        }
    } catch (error) {
        console.log("error al cargar productos temporales " + error);
    }
}

async function buscar_cliente_venta() {
    let dni = document.getElementById('cliente_dni').value.trim();
    if (!dni) {
        return Swal.fire({ icon: 'warning', title: 'DNI requerido', timer: 1200, showConfirmButton: false });
    }
    try {
        const datos = new FormData();
        datos.append('dni', dni);
        let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=buscar_por_dni', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        const json = await respuesta.json();
        if (json.status && json.data) {
            document.getElementById('cliente_nombre').value = json.data.razon_social || '';
            document.getElementById('id_cliente_venta').value = json.data.id || '';
            Swal.fire({ icon: 'success', title: 'Cliente encontrado', timer: 1000, showConfirmButton: false });
        } else {
            document.getElementById('cliente_nombre').value = '';
            document.getElementById('id_cliente_venta').value = '';
            Swal.fire({ icon: 'error', title: 'No encontrado', text: json.msg || 'Cliente no encontrado' });
        }
    } catch (error) {
        console.log('error al buscar cliente por dni ' + error);
        Swal.fire({ icon: 'error', title: 'Error', text: 'No fue posible buscar el cliente' });
    }
}


async function registrarVenta() {
    let id_cliente = document.getElementById('id_cliente_venta').value;
    let fecha_venta = document.getElementById('fecha_venta').value;
    if (id_cliente == '' || fecha_venta == '') {
        return alert("debe completar todos los campos");
    }
    try {
        const datos = new FormData();
        datos.append('id_cliente', id_cliente);
        datos.append('fecha_venta', fecha_venta);

        let respuesta = await fetch(base_url + 'control/VentaController.php?tipo=registrar_venta', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            alert("venta registrada con exito");
            window.location.reload();
        } else {
            alert(json.msg);
        }
    } catch (error) {
        console.log("error al registrar venta " + error);
    }
}