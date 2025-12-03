<table style="border: 1px solid;">
    <tr style="border: 1px solid;">
        <td style="border: 1px solid;">ID</td>
        <td style="border: 1px solid;">NombreUsuari</td>
        <td style="border: 1px solid;">Contra</td>
        <td style="border: 1px solid;">Nom</td>
        <td style="border: 1px solid;">Cognom</td>
        <td style="border: 1px solid;">Correu</td>
        <td style="border: 1px solid;">Rol</td>
        <td style="border: 1px solid;">Telefon</td>
    </tr>
    <?php foreach ($usuaris as $usuari) { ?>
        <tr style="border: 1px solid;">
            <td style="border: 1px solid;"><?=$usuari->getId() . ' ';?></td>
            <td style="border: 1px solid;"><?=$usuari->getNomUsuari() . ' ';?></td>
            <td style="border: 1px solid;"><?=$usuari->getContrasenya() . ' ';?></td>
            <td style="border: 1px solid;"><?=$usuari->getNom() . ' ';?></td>
            <td style="border: 1px solid;"><?=$usuari->getCognoms() . ' ';?></td>
            <td style="border: 1px solid;"><?=$usuari->getCorreu() . ' ';?></td>
            <td style="border: 1px solid;"><?=$usuari->getRol() . ' ';?></td>
            <td style="border: 1px solid;"><?=$usuari->getTelefon() . ' ';?></td>
        </tr>
    <?php } ?>
</table>

