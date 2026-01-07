// Carrito (localStorage) – inspirat en el projecte de referència

function obtenerCarrito() {
  const carrito = localStorage.getItem('carrito');
  return carrito ? JSON.parse(carrito) : [];
}

function guardarCarrito(carrito) {
  localStorage.setItem('carrito', JSON.stringify(carrito));
  actualizarContadorCarrito();
}

function anadirAlCarrito(id_producto, nombre, precio, imagen, cantidad = 1) {
  const carrito = obtenerCarrito();
  const nuevoProducto = {
    id_producto: id_producto,
    nombre: nombre,
    precio: parseFloat(precio),
    imagen: imagen,
    cantidad: cantidad
  };

  const existente = carrito.find(p => p.id_producto === id_producto);
  if (existente) {
    existente.cantidad += cantidad;
  } else {
    carrito.push(nuevoProducto);
  }

  guardarCarrito(carrito);
}

function contarProductos() {
  const carrito = obtenerCarrito();
  return carrito.reduce((total, p) => total + (p.cantidad || 0), 0);
}

function calcularTotal() {
  const carrito = obtenerCarrito();
  return carrito.reduce((total, p) => total + (parseFloat(p.precio) * (p.cantidad || 0)), 0);
}

function actualizarContadorCarrito() {
  const contador = document.getElementById('contador-carrito');
  if (!contador) return;
  const total = contarProductos();
  contador.textContent = total;
  contador.style.display = total > 0 ? 'inline-block' : 'none';
}

function guardarCarritoSinAlerta(carrito) {
  localStorage.setItem('carrito', JSON.stringify(carrito));
  actualizarContadorCarrito();
}

function eliminarProducto(id_producto) {
  if (!confirm('¿Eliminar este producto del carrito?')) return;
  let carrito = obtenerCarrito();
  carrito = carrito.filter(p => (p.id_producto != id_producto) && (p.id != id_producto));
  guardarCarritoSinAlerta(carrito);
  renderizarCarrito();
}

function cambiarCantidad(id_producto, cambio) {
  const carrito = obtenerCarrito();
  const item = carrito.find(p => (p.id_producto == id_producto) || (p.id == id_producto));
  if (!item) return;
  const nueva = (item.cantidad || 0) + cambio;
  if (nueva <= 0) {
    eliminarProducto(id_producto);
    return;
  }
  item.cantidad = nueva;
  guardarCarritoSinAlerta(carrito);
  renderizarCarrito();
}

function confirmarVaciar() {
  if (!confirm('¿Vaciar todo el carrito?')) return;
  localStorage.removeItem('carrito');
  actualizarContadorCarrito();
  renderizarCarrito();
}

function renderizarCarrito() {
  const carrito = obtenerCarrito();
  const contenedor = document.getElementById('lista-productos-carrito');
  if (!contenedor) return;

  const subtotalElement = document.getElementById('subtotal-carrito');
  const ivaElement = document.getElementById('iva-carrito');
  const totalElement = document.getElementById('total-carrito');

  if (!carrito || carrito.length === 0) {
    contenedor.innerHTML = '<div class="alert alert-info">El carrito està buit.</div>';
    if (subtotalElement) subtotalElement.textContent = '0,00 €';
    if (ivaElement) ivaElement.textContent = '0,00 €';
    if (totalElement) totalElement.textContent = '0,00 €';
    return;
  }

  let html = '';
  carrito.forEach(item => {
    const itemId = (item.id_producto ?? item.id);
    const subtotal = (parseFloat(item.precio) * (item.cantidad || 0));
    html += `
      <div class="card mb-3" data-id="${itemId}">
        <div class="card-body d-flex justify-content-between align-items-center gap-3 flex-wrap">
          <div style="min-width: 220px;">
            <div><strong>${item.nombre}</strong></div>
            <div class="text-muted">${parseFloat(item.precio).toFixed(2)} € / unitat</div>
          </div>
          <div class="btn-group" role="group" aria-label="Cantidad">
            <button class="btn btn-outline-secondary" onclick="cambiarCantidad('${itemId}', -1)">-</button>
            <button class="btn btn-outline-secondary" disabled>${item.cantidad}</button>
            <button class="btn btn-outline-secondary" onclick="cambiarCantidad('${itemId}', 1)">+</button>
          </div>
          <div style="min-width: 120px;" class="text-end"><strong>${subtotal.toFixed(2)} €</strong></div>
          <button class="btn btn-outline-danger" onclick="eliminarProducto('${itemId}')">Eliminar</button>
        </div>
      </div>
    `;
  });

  contenedor.innerHTML = html;

  const subtotal = calcularTotal();
  const iva = subtotal * 0.10;
  const total = subtotal + iva;
  if (subtotalElement) subtotalElement.textContent = subtotal.toFixed(2).replace('.', ',') + ' €';
  if (ivaElement) ivaElement.textContent = iva.toFixed(2).replace('.', ',') + ' €';
  if (totalElement) totalElement.textContent = total.toFixed(2).replace('.', ',') + ' €';
}

document.addEventListener('DOMContentLoaded', actualizarContadorCarrito);
