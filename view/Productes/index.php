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
</section>



















