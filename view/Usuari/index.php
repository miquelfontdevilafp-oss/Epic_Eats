<table style="border: 1px solid;">
    <tr style="border: 1px solid;">
        <td style="border: 1px solid;">ID</td>
        <td style="border: 1px solid;">Nombre</td>
        <td style="border: 1px solid;">Cuidad</td>
        <td style="border: 1px solid;">Pais</td>
        <td style="border: 1px solid;">Show</td>
    </tr>
    <?php foreach ($usuaris as $usuari) { ?>
        <tr style="border: 1px solid;">
            <td style="border: 1px solid;"><?=$usuari->getId() . ' ';?></td>
            <td style="border: 1px solid;"><?=$usuari->getNombre() . ' ';?></td>
            <td style="border: 1px solid;"><?=$usuari->getCuidad() . ' ';?></td>
            <td style="border: 1px solid;"><?=$usuari->getPais() . ' ';?></td>
            <td style="border: 1px solid;"><a href="?controller=usuari$usuari&action=show&idusuari$usuari=<?=$usuari->getId();?>">show</a></td>
        </tr>
    <?php } ?>
</table>

