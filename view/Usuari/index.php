<table style="border: 1px solid;">
    <tr style="border: 1px solid;">
        <td style="border: 1px solid;">ID</td>
        <td style="border: 1px solid;">Nombre</td>
        <td style="border: 1px solid;">Cuidad</td>
        <td style="border: 1px solid;">Pais</td>
        <td style="border: 1px solid;">Show</td>
    </tr>
    <?php var_dump($usuaris)?>
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

