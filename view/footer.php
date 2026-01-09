<footer id="site-footer" class="ee-footer">
    <div class="container-fluid ee-footer-inner">

        <!-- Top: brand + social -->
        <div class="row align-items-center gy-3 ee-footer-top">
            <div class="col-12 col-md-6">
                <a class="ee-footer-brand" href="<?= BASE_URL ?>/?controller=Home&action=Home">
                    <!-- Epic Eats logo + STORE (avoid duplicate "STORE" inside the image) -->
                    <img class="ee-brand-logo" src="<?= BASE_URL ?>/IMG/Logo_EpicEats_Claro.svg" alt="Epic Eats">
                    <span class="ee-brand-text">STORE</span>
                </a>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-md-end gap-2">
                <a class="ee-social" href="#" aria-label="Facebook">
                    <img class="iconoRedSocial" src="<?= BASE_URL ?>/IMG/Logo Facebock.png" alt="Facebook">
                </a>
                <a class="ee-social" href="#" aria-label="X">
                    <img class="iconoRedSocial" src="<?= BASE_URL ?>/IMG/Logo X.png" alt="X">
                </a>
                <a class="ee-social" href="#" aria-label="YouTube">
                    <img class="iconoRedSocial" src="<?= BASE_URL ?>/IMG/Logo Youtube.png" alt="YouTube">
                </a>
            </div>
        </div>

        <hr class="ee-hr">

        <!-- Links -->
        <nav class="ee-footer-links" aria-label="Footer">
            <a href="<?= BASE_URL ?>/?controller=Home&action=Home">Inici</a>
            <a href="#">Restaurant</a>
            <a href="<?= BASE_URL ?>/?controller=Productes&action=carta">La nostre carta</a>
            <a class="ee-disabled-link" href="#" aria-disabled="true" tabindex="-1">Reserva</a>
            <a href="#">Contacte</a>
            <a href="#">Avis legal</a>
            <a href="#">Configuracio de cookies</a>
            <a href="#">Politica de reembols</a>
            <a href="#">Termes d’us</a>
        </nav>

        <hr class="ee-hr">

        <!-- Bottom: legal + back to top -->
        <div class="row align-items-start gy-3 ee-footer-bottom">
            <div class="col-12 col-lg-9">
                <p class="ee-legal">
                    © 2025, Epic Eats, Inc. Todos los derechos reservados. Epic, Epic Games, el logotipo de Epic Games, Fortnite,
                    el logotipo de Fortnite, Unreal, Unreal Engine, el logotipo de Unreal Engine, Unreal Tournament y el logotipo de
                    Unreal Tournament son marcas comerciales o marcas registradas de Epic Games, Inc. tanto en Estados Unidos de
                    América como en el resto del mundo. Otras marcas o nombres de productos son marcas comerciales de sus respectivos
                    propietarios. Nuestros sitios web pueden incluir enlaces a otros sitios y recursos ofrecidos por terceros. Estos
                    enlaces solo se ofrecen para tu mayor comodidad. Epic Games no tiene control sobre el contenido de esos sitios y
                    recursos, y no acepta ninguna responsabilidad por ellos ni por cualquier pérdida o daño que pueda ocasionar el uso
                    que haces de ellos.
                </p>
            </div>
            <div class="col-12 col-lg-3 d-flex justify-content-lg-end align-items-center gap-3">
                <a class="ee-to-top" href="#navbar">
                    Torna a l'inici
                    <svg class="svg24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </a>
                <span class="ee-info-dot" aria-hidden="true">i</span>
            </div>
        </div>
    </div>
</footer>
