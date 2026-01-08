<section id="home">
    <section id="sector_productes_setmana" class="row container d-flex justify-content-center">
        <?php
            $hero = $homeHero ?? null;
            $heroNom = $hero['nom'] ?? 'Producte destacat';
            $heroDesc = $hero['descripcio'] ?? 'Descobreix el nostre producte destacat.';
        ?>
        <div class="col-8 d-flex align-items-end justify-content-center text-center">
            <div>
                <h2><?= htmlspecialchars($heroNom) ?></h2>
                <p><?= htmlspecialchars($heroDesc) ?></p>
                <a class="btn btn-primary" href="<?= BASE_URL ?>/?controller=Productes&action=carta">Demana ja</a>
            </div>
        </div>

        <div class="col-2" id="home_sidebar">
            <?php foreach (($homeSidebar ?? []) as $p):
                $img = (!empty($p['imatge'])) ? (BASE_URL . '/IMG/' . $p['imatge']) : (BASE_URL . '/IMG/ImgNotFound.png');
            ?>
                <div class="row d-flex align-items-center justify-content-center text-center home_sidebar_item">
                    <div class="col-auto">
                        <img src="<?= $img ?>" alt="img-producte" class="home_sidebar_img">
                    </div>
                    <h4 class="col home_sidebar_title"><?= htmlspecialchars($p['nom'] ?? 'Producte') ?></h4>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section id="Descobreix_Productes" class="row container col-10 justify-content-center text-center">
        <div class="row">
            <div class="col">
                <h2>Descobreix algo nou</h2>
            </div>
            <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 svg32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 svg32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </div>
        </div>
        <div class="row justify-content-center" id="home_descobreix_row">
            <?php foreach (($homeDescobreix ?? []) as $idx => $p):
                $img = (!empty($p['imatge'])) ? (BASE_URL . '/IMG/' . $p['imatge']) : (BASE_URL . '/IMG/ImgNotFound.png');
                $preu = $p['preu_final'] ?? ($p['preu_unitat'] ?? null);
            ?>
                <div class="col home_descobreix_card <?= $idx === 0 ? 'home_descobreix_first' : '' ?>">
                    <img src="<?= $img ?>" alt="" class="img_descobreix_productes">
                    <p class="home_card_nom"><?= htmlspecialchars($p['nom'] ?? 'Producte') ?></p>
                    <?php if ($preu !== null): ?>
                        <p class="home_card_preu"><?= number_format((float)$preu, 2, ',', '.') ?>€</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section id="Revaixes" class="row container justify-content-center text-center">
        <div class="row">
            <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 svg32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
                <h2>Rebaixes més populars</h2>
            </div>
            <div class="col">
                <button>Mirar més</button>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php foreach (($homeRebaixes ?? []) as $p):
                $nom = $p['nom'] ?? 'Producte';
                $preu = $p['preu_final'] ?? ($p['preu_unitat'] ?? null);
            ?>
                <div class="col home_rebaixa_item">
                    <a href="<?= BASE_URL ?>/?controller=Productes&action=carta" class="home_rebaixa_title"><?= htmlspecialchars($nom) ?></a>
                    <?php if ($preu !== null): ?>
                        <p class="home_rebaixa_preu"><?= number_format((float)$preu, 2, ',', '.') ?>€</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section id="Vegudes" class="row container">
        <div class="row">
            <div class="col">
                <h2>Les nostres categories</h2>
            </div>
            <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 svg32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 svg32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>més vengut</p>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <p>més vengut</p>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <p>més vengut</p>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img src="<?=BASE_URL?>/IMG/ImgNotFound.png" alt="">
                    </div>
                    <div>
                        <p>Beguda</p>
                        <p>preu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>