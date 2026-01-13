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
            <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                <h5 class="card-title mb-0">Resum de compra</h5>
                <div class="d-flex align-items-center gap-2">
                    <label for="checkout-currency" class="form-label mb-0 small text-muted">Moneda</label>
                    <select id="checkout-currency" class="form-select form-select-sm" style="width: 120px;">
                        <option value="EUR">EUR (€)</option>
                        <option value="USD">USD ($)</option>
                    </select>
                </div>
            </div>
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
    const FX_CACHE_KEY = 'fx_eur_usd';
    const FX_TTL_MS = 12 * 60 * 60 * 1000; // 12h

    function getStoredFx() {
        try {
            const raw = localStorage.getItem(FX_CACHE_KEY);
            if (!raw) return null;
            const parsed = JSON.parse(raw);
            if (!parsed || typeof parsed.rate !== 'number' || typeof parsed.ts !== 'number') return null;
            if ((Date.now() - parsed.ts) > FX_TTL_MS) return null;
            return parsed.rate;
        } catch (_) {
            return null;
        }
    }

    function storeFx(rate) {
        try {
            localStorage.setItem(FX_CACHE_KEY, JSON.stringify({ rate, ts: Date.now() }));
        } catch (_) {}
    }

    async function getEurUsdRate() {
        const cached = getStoredFx();
        if (cached) return cached;

        const res = await fetch('https://api.frankfurter.app/latest?from=EUR&to=USD', { cache: 'no-store' });
        if (!res.ok) throw new Error('No s\'ha pogut obtenir el canvi EUR/USD');
        const data = await res.json();
        const rate = data && data.rates ? Number(data.rates.USD) : NaN;
        if (!Number.isFinite(rate) || rate <= 0) throw new Error('Resposta de canvi no vàlida');
        storeFx(rate);
        return rate;
    }

    function moneyFormatter(currency) {
        return new Intl.NumberFormat('es-ES', {
            style: 'currency',
            currency,
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function getSelectedCurrency() {
        const sel = document.getElementById('checkout-currency');
        return sel ? sel.value : 'EUR';
    }

    function setSelectedCurrency(value) {
        const sel = document.getElementById('checkout-currency');
        if (sel) sel.value = value;
        try { localStorage.setItem('checkout_currency', value); } catch (_) {}
    }

    function restoreSelectedCurrency() {
        try {
            const v = localStorage.getItem('checkout_currency');
            return (v === 'USD' || v === 'EUR') ? v : 'EUR';
        } catch (_) {
            return 'EUR';
        }
    }

    async function renderCheckout() {
        const carrito = obtenerCarrito();
        const cont = document.getElementById('checkout-resumen');
        const totalEl = document.getElementById('checkout-total');
        const currency = getSelectedCurrency();

        if (!carrito || carrito.length === 0) {
            cont.innerHTML = '<p class="text-muted">El carrito està buit.</p>';
            totalEl.textContent = moneyFormatter(currency).format(0);
            return;
        }

        let rate = 1;
        if (currency === 'USD') {
            try {
                rate = await getEurUsdRate();
            } catch (e) {
                // Si falla, tornem a EUR per evitar mostrar imports incorrectes.
                setSelectedCurrency('EUR');
                alert('No s\'ha pogut carregar el canvi EUR/USD. Es mostrarà en EUR.');
                return renderCheckout();
            }
        }

        const fmt = moneyFormatter(currency);
        let html = '<ul class="list-group">';
        carrito.forEach(p => {
            const unitEur = Number(p.precio);
            const qty = Number(p.cantidad || 0);
            const lineEur = unitEur * qty;

            const unit = unitEur * rate;
            const line = lineEur * rate;

            html += `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <div><strong>${p.nombre}</strong></div>
                        <small class="text-muted">${qty} x ${fmt.format(unit)}</small>
                    </div>
                    <div>${fmt.format(line)}</div>
                </li>
            `;
        });
        html += '</ul>';
        cont.innerHTML = html;

        const subtotalEur = calcularTotal();
        const ivaEur = subtotalEur * 0.10;
        const totalFinalEur = subtotalEur + ivaEur;

        const totalFinal = totalFinalEur * rate;
        totalEl.textContent = fmt.format(totalFinal);
    }

    document.addEventListener('DOMContentLoaded', function() {
        setSelectedCurrency(restoreSelectedCurrency());
        const sel = document.getElementById('checkout-currency');
        if (sel) sel.addEventListener('change', renderCheckout);
        renderCheckout();
    });

    async function procesarPedido() {
        const carrito = obtenerCarrito();
        if (!carrito || carrito.length === 0) {
            alert('El carrito está vacío');
            return;
        }

        const payloadProductos = carrito.map(p => ({
            id_producto: p.id_producto ?? p.id,
            cantidad: p.cantidad ?? 1
        }));

        const res = await fetch('<?= BASE_URL ?>/api/carrito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                accion: 'procesar',
                productos: payloadProductos
            })
        });


        const data = await res.json().catch(() => null);
        if (!res.ok) {
            alert((data && data.mensaje) ? data.mensaje : 'Error al procesar el pedido');
            if (res.status === 401) {
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