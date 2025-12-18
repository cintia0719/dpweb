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

const base_url = "https://cintiadpweb.kileando.com/";

/* ============================
   AGREGAR PRODUCTO TEMPORAL
=============================== */
function agregar_producto_temporal(id_producto, precio) {
    const formData = new FormData();
    formData.append("id_producto", id_producto);
    formData.append("precio", precio);
    formData.append("cantidad", 1);

    fetch(`${base_url}control/VentaController.php?tipo=registrarTemporal`, {
        method: "POST",
        body: formData
    })
    .then(response => response.text()) // ⚠️ primero TEXTO
    .then(text => {
        try {
            const data = JSON.parse(text);
            if (data.status) {
                listar_venta_temporal();
            } else {
                alert("Error: " + data.msg);
            }
        } catch (e) {
            console.error("Respuesta NO es JSON:", text);
            alert("Error del servidor. Revisa PHP.");
        }
    })
    .catch(error => {
        console.error("Fetch error:", error);
        alert("Error de conexión con el servidor");
    });
}

/* ============================
   LISTAR VENTA TEMPORAL
=============================== */
function listar_venta_temporal() {
    fetch(`${base_url}control/VentaController.php?tipo=listar_venta_temporal`)
    .then(response => response.text())
    .then(text => {
        try {
            const data = JSON.parse(text);
            if (!data.status) return;

            let html = "";
            let total = 0;

            data.data.forEach(item => {
                let subtotal = item.precio * item.cantidad;
                total += subtotal;

                html += `
                    <tr>
                        <td>${item.nombre}</td>
                        <td>
                            <input type="number" min="1" value="${item.cantidad}"
                                onchange="actualizar_cantidad(${item.id}, this.value)">
                        </td>
                        <td>S/. ${item.precio}</td>
                        <td>S/. ${subtotal.toFixed(2)}</td>
                        <td>
                            <button onclick="eliminar_temporal(${item.id})">❌</button>
                        </td>
                    </tr>
                `;
            });

            document.getElementById("detalle_venta").innerHTML = html;
            document.getElementById("total").innerText = "S/. " + total.toFixed(2);

        } catch (e) {
            console.error("Respuesta NO JSON:", text);
        }
    })
    .catch(error => console.error(error));
}

/* ============================
   ACTUALIZAR CANTIDAD
=============================== */
function actualizar_cantidad(id, cantidad) {
    const formData = new FormData();
    formData.append("id", id);
    formData.append("cantidad", cantidad);

    fetch(`${base_url}control/VentaController.php?tipo=actualizar_cantidad`, {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(text => {
        try {
            const data = JSON.parse(text);
            if (data.status) {
                listar_venta_temporal();
            }
        } catch (e) {
            console.error("Error JSON:", text);
        }
    });
}

/* ============================
   ELIMINAR PRODUCTO
=============================== */
function eliminar_temporal(id) {
    const formData = new FormData();
    formData.append("id", id);

    fetch(`${base_url}control/VentaController.php?tipo=eliminar_temporal`, {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(text => {
        try {
            const data = JSON.parse(text);
            if (data.status) {
                listar_venta_temporal();
            }
        } catch (e) {
            console.error("Error JSON:", text);
        }
    });
}

/* ============================
   REGISTRAR VENTA
=============================== */
function registrar_venta() {
    const formData = new FormData();
    formData.append("id_cliente", document.getElementById("id_cliente").value);
    formData.append("fecha_venta", document.getElementById("fecha_venta").value);

    fetch(`${base_url}control/VentaController.php?tipo=registrar_venta`, {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(text => {
        try {
            const data = JSON.parse(text);
            if (data.status) {
                alert("Venta registrada correctamente");
                listar_venta_temporal();
            } else {
                alert(data.msg);
            }
        } catch (e) {
            console.error("Respuesta NO JSON:", text);
            alert("Error al registrar venta");
        }
    });
}

/* ============================
   CARGA INICIAL
=============================== */
document.addEventListener("DOMContentLoaded", () => {
    listar_venta_temporal();
});
