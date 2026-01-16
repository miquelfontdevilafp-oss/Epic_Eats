<section id="home">
    <section id="sector_productes_setmana" class="container">
        <?php
            $mkImgUrl = function ($img) {
                $img = (string)($img ?: 'IMG/ImgNotFound.png');
                if (str_starts_with($img, 'http') || str_starts_with($img, '/')) {
                    return $img;
                }
                return BASE_URL . '/' . ltrim($img, '/');
            };

            $trimText = function (string $txt, int $max): string {
                $txt = trim($txt);
                if ($txt === '' || $max <= 0) return '';
                if (function_exists('mb_strimwidth')) {
                    return mb_strimwidth($txt, 0, $max, '…');
                }
                if (strlen($txt) <= $max) return $txt;
                return substr($txt, 0, max(0, $max - 1)) . '…';
            };

            $heroMainNom  = $heroMain ? (string)($heroMain->getNom() ?? '') : 'Producte';
            $heroMainDesc = $heroMain ? (string)($heroMain->getDescripcio() ?? '') : '';
            $heroMainImg  = $heroMain ? (string)($heroMain->getImatge() ?? '') : 'IMG/ImgNotFound.png';
            $heroMainImgUrl = $mkImgUrl($heroMainImg);

            $heroSecNom  = $heroSecondary ? (string)($heroSecondary->getNom() ?? '') : $heroMainNom;
            $heroSecDesc = $heroSecondary ? (string)($heroSecondary->getDescripcio() ?? '') : $heroMainDesc;
            $heroSecImg  = $heroSecondary ? (string)($heroSecondary->getImatge() ?? '') : $heroMainImg;
            $heroSecImgUrl = $mkImgUrl($heroSecImg);
        ?>

        <div class="hero-track" data-scroll-dots="hero">
            <article class="hero-card hero-main" style="--hero-image: url('<?= htmlspecialchars($heroMainImgUrl, ENT_QUOTES, 'UTF-8') ?>');">
                <div class="hero-content">
                    <h2><?= htmlspecialchars($heroMainNom, ENT_QUOTES, 'UTF-8') ?></h2>
                    <p><?= htmlspecialchars($trimText($heroMainDesc, 180), ENT_QUOTES, 'UTF-8') ?></p>
                    <button type="button" onclick="location.href='<?= BASE_URL ?>/?controller=Productes&action=carta'">Demana ja</button>
                </div>
            </article>

            <article class="hero-card hero-secondary d-lg-none" style="--hero-image: url('<?= htmlspecialchars($heroSecImgUrl, ENT_QUOTES, 'UTF-8') ?>');">
                <div class="hero-content">
                    <h2><?= htmlspecialchars($heroSecNom, ENT_QUOTES, 'UTF-8') ?></h2>
                    <p><?= htmlspecialchars($trimText($heroSecDesc, 90), ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            </article>
        </div>
        <div class="scroll-dots d-lg-none" data-dots-for="hero" aria-label="Paginació hero"></div>

        <aside class="hero-sidebar d-none d-lg-block">
            <?php foreach (($sidebarProducts ?? []) as $sp): ?>
                <?php
                    $spNom = (string)($sp->getNom() ?? '');
                    $spImg = (string)($sp->getImatge() ?: 'IMG/ImgNotFound.png');
                    $spImgUrl = $mkImgUrl($spImg);
                ?>
                <a class="sidebar-item" href="<?= BASE_URL ?>/?controller=Productes&action=carta">
                    <img src="<?= htmlspecialchars($spImgUrl, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($spNom, ENT_QUOTES, 'UTF-8') ?>" onerror="this.src='<?= BASE_URL ?>/IMG/ImgNotFound.png'">
                    <div>
                        <span class="sidebar-kicker">Producte</span>
                        <span class="sidebar-title"><?= htmlspecialchars($spNom, ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </aside>
    </section>

    <section id="Descobreix_Productes" class="container">
        <div class="section-header">
            <h2>Descobreix algo nou</h2>
            <div class="section-actions d-none d-lg-flex" aria-label="Navegació secció">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 svg32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 svg32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </div>
        </div>

        <div class="product-track" data-scroll-dots="descobreix" aria-label="Llista de productes">
            <?php foreach (($descobreixProducts ?? []) as $p): ?>
                <?php
                    $pid  = (int)$p->getId();
                    $nom  = (string)($p->getNom() ?? '');
                    $preu = (float)($p->getPreuUnitat() ?? 0);
                    $img  = (string)($p->getImatge() ?: 'IMG/ImgNotFound.png');
                    $imgUrl = $mkImgUrl($img);

                    $cats = $mapProducteCategories[$pid] ?? [];
                    $catName = 'Menjar';
                    if (!empty($cats)) {
                        $first = (int)$cats[0];
                        if (!empty($categoriasById[$first])) {
                            $catName = (string)$categoriasById[$first];
                        }
                    }
                ?>
                <article class="product-card">
                    <img src="<?= htmlspecialchars($imgUrl, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') ?>" class="img_descobreix_productes" onerror="this.src='<?= BASE_URL ?>/IMG/ImgNotFound.png'">
                    <div class="product-meta">
                        <span class="product-category"><?= htmlspecialchars($catName, ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="product-title"><?= htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="product-price"><?= number_format($preu, 2) ?>€</span>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="scroll-dots d-lg-none" data-dots-for="descobreix" aria-label="Paginació productes"></div>
    </section>
    <section id="Categories" class="container">
        <div class="row">
            <div class="col">
                <h2>Les nostres categories</h2>
            </div>
            <div class="col col-auto ms-auto text-end">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 svg32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 svg32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </div>
        </div>
        <div class="row">
            <?php foreach (($homeCategories ?? []) as $c): ?>
                <?php
                    $cNom = (string)($c->getNom() ?? '');
                    $cImg = (string)($c->getImatge() ?: 'IMG/ImgNotFound.png');
                    $cImgUrl = $mkImgUrl($cImg);
                ?>
                <div class="col">
                    <img src="<?= htmlspecialchars($cImgUrl, ENT_QUOTES, 'UTF-8') ?>"
                         alt="<?= htmlspecialchars($cNom, ENT_QUOTES, 'UTF-8') ?>"
                         onerror="this.src='<?= BASE_URL ?>/IMG/ImgNotFound.png'">
                    <a href="<?= BASE_URL ?>/?controller=Productes&action=carta"><?= htmlspecialchars((string)$c->getNom(), ENT_QUOTES, 'UTF-8') ?></a>
                    <p></p>
                    <a href="<?= BASE_URL ?>/?controller=Productes&action=carta">Veure la tenda</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section id="Revaixes" class="container">
        <div class="row">
            <div class="col revaixes-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 svg32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
                <h2>Rebaixes més populars</h2>
            </div>
            <div class="col col-auto ms-auto text-end">
                <button type="button" onclick="location.href='<?= BASE_URL ?>/?controller=Productes&action=carta'">Mirar més</button>
            </div>
        </div>
        <div class="row">
            <?php if (!empty($rebaixesProducts ?? [])): ?>
                <?php foreach ($rebaixesProducts as $r): ?>
                    <?php
                        $nom = (string)($r['nom'] ?? '');
                        $preuUnitat = (float)($r['preu_unitat'] ?? 0);
                        $preuFinal = (float)($r['preu_final'] ?? $preuUnitat);
                        $img = (string)($r['imatge'] ?? 'IMG/ImgNotFound.png');
                        $imgUrl = $mkImgUrl($img);
                    ?>
                    <div class="col">
                        <a class="rebaixa-card" href="<?= BASE_URL ?>/?controller=Productes&action=carta" aria-label="<?= htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') ?>">
                            <img class="rebaixa-img" src="<?= htmlspecialchars($imgUrl, ENT_QUOTES, 'UTF-8') ?>"
                                 alt="<?= htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') ?>"
                                 onerror="this.src='<?= BASE_URL ?>/IMG/ImgNotFound.png'"><br>
                            <span class="rebaixa-title"><?= htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="rebaixa-price">
                                <span class="rebaixa-old"><?= number_format($preuUnitat, 2) ?>€</span>
                                <strong class="rebaixa-new"><?= number_format($preuFinal, 2) ?>€</strong>
                            </span>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col">
                    <p class="text-muted">Ara mateix no hi ha rebaixes actives.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <script src="<?= BASE_URL ?>/JS/home.js"></script>
</section>