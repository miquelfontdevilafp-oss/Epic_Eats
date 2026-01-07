<section class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">Carrito</h3>
        <div>
            <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/?controller=Productes&action=carta">Continuar comprant</a>
        </div>
    </div>

    <div id="lista-productos-carrito"></div>

    <hr class="my-4">

    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-outline-danger" onclick="confirmarVaciar()">Vaciar carrito</button>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <div class="mb-1">Subtotal: <strong id="subtotal-carrito">0,00 €</strong></div>
            <div class="mb-1">IVA (10%): <strong id="iva-carrito">0,00 €</strong></div>
            <div class="mb-3">Total: <strong id="total-carrito">0,00 €</strong></div>

            <a class="btn btn-primary" href="<?= BASE_URL ?>/?controller=Carrito&action=checkout" onclick="return validarCheckout()">Tramitar pedido</a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        renderizarCarrito();
        actualizarContadorCarrito();
    });

    function validarCheckout(){
        const c = obtenerCarrito();
        if(!c || c.length===0){
            alert('El carrito está vacío');
            return false;
        }
        return true;
    }
</script>