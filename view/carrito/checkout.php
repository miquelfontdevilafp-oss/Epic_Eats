<section class="container py-5" style="max-width: 820px;">
    <h3 class="mb-3">Checkout</h3>

    <?php if (!isset($_SESSION['usuario'])): ?>
        <div class="alert alert-warning">
            Has d'iniciar sessió per poder tramitar el pedido.
            <a href="<?= BASE_URL ?>/?controller=Auth&action=login">Inicia sessió</a>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Resum de compra</h5>
            <div id="checkout-resumen" class="mt-3"></div>
            <hr>
            <div class="d-flex justify-content-between">
                <strong>Total</strong>
                <strong id="checkout-total">0,00 €</strong>
            </div>

            <button class="btn btn-primary w-100 mt-3" onclick="procesarPedido()" <?= isset($_SESSION['usuario']) ? '' : 'disabled' ?>>Pagar i crear comanda</button>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const carrito = obtenerCarrito();
    const cont = document.getElementById('checkout-resumen');
    const totalEl = document.getElementById('checkout-total');

    if(!carrito || carrito.length===0){
        cont.innerHTML = '<p class="text-muted">El carrito está vacío.</p>';
        totalEl.textContent = '0,00 €';
        return;
    }

    let html = '<ul class="list-group">';
    carrito.forEach(p => {
        const lineTotal = (p.precio * p.cantidad);
        html += `<li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <div><strong>${p.nombre}</strong></div>
                <small class="text-muted">${p.cantidad} x ${p.precio.toFixed(2)} €</small>
            </div>
            <div>${lineTotal.toFixed(2)} €</div>
        </li>`;
    });
    html += '</ul>';
    cont.innerHTML = html;

    const total = calcularTotal();
    const iva = total * 0.10;
    const totalFinal = total + iva;
    totalEl.textContent = totalFinal.toFixed(2).replace('.', ',') + ' €';
});

async function procesarPedido(){
    const carrito = obtenerCarrito();
    if(!carrito || carrito.length===0){
        alert('El carrito está vacío');
        return;
    }

    const subtotal = calcularTotal();
    const iva = subtotal * 0.10;
    const total = subtotal + iva;

    const res = await fetch('<?= BASE_URL ?>/api/carrito.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({accion:'procesar', productos: carrito, total: total})
    });

    const data = await res.json().catch(() => null);
    if(!res.ok){
        alert((data && data.mensaje) ? data.mensaje : 'Error al procesar el pedido');
        if(res.status === 401){
            window.location.href = '<?= BASE_URL ?>/?controller=Auth&action=login';
        }
        return;
    }

    // Buidar carrito i anar a confirmació
    localStorage.removeItem('carrito');
    actualizarContadorCarrito();
    window.location.href = '<?= BASE_URL ?>/?controller=Carrito&action=confirmacion&id=' + encodeURIComponent(data.data.id_comanda);
}
</script>
