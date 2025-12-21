<section id="productes">
    <table>
    <tr>
        <td>id</td>
        <td>nom</td>
        <td>descripcio</td>
        <td>preuUnitat</td>
        <td>imatge</td>
        <td>enCarta</td>
    </tr>
    <?php foreach ($productes as $producte) { ?>
        <tr>
            <td><?=$producte->getId() . ' ';?></td>
            <td><?=$producte->getNom() . ' ';?></td>
            <td><?=$producte->getDescripcio() . ' ';?></td>
            <td><?=$producte->getPreuUnitat() . ' ';?></td>
            <td><?=$producte->getImatge() . ' ';?></td>
            <td><?=$producte->getEnCarta() . ' ';?></td>
        </tr>
    <?php } ?>
    </table>
    <?php foreach ($productes as $producte) { ?>
        <div class="container productes">
            <h2><?= $producte->getNom() ?></h2>
            <img src="<?= $producte->getImatge()?>" alt="<?= $producte->getNom()?>">
            <p><?= $producte->getDescripcio()?></p>
            <p><?= $producte->getPreuUnitat()?></p>
            <label for="quantitatProducte<?= $producte->getId()?>"></label>
            <input type="number" name="quantitatProducte<?= $producte->getId()?>" id="quantitatProducte<?= $producte->getId()?>" min="0">
            <button id="<?= $producte->getId()?>" class="btn-carrito">Afagir al carrillo</button>
        </div>
    <?php } ?>
</section>



















