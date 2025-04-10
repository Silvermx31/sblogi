<?php
$sql = "SELECT id, heading, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') as added FROM blog ORDER BY added DESC";
$data = $db->dbGetArray($sql);
//$db->show($data); //test

?>

<div class="row mt-1">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <?php
        if($data !== false) {
            ?>
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>Jrk</th>
                        <th>Pealkiri</th>
                        <th>Lisatud</th>
                        <th>Tegevus</th>
                    </tr>
                </thead>
            
                <tbody>
                    <?php
                    for($x = 0; $x < count($data); $x++) {  //$x+=1 või $x=$+1
                        ?>
                        <tr>
                            <td class="text-end"><?= ($x+1); ?>.</td>
                            <td><?= $data[$x]['heading']; ?></td>
                            <td><?= $data[$x]['added']; ?></td>
                            <td class="text-center">
                                <a href="?page=edit&sid=<?= $data[$x]['id']; ?>" title="Muuda"><i class="fa-solid fa-pen-to-square text-primary"></i></a>
                                <i class="fa-solid fa-trash text-danger"></i>
                            </td>
                        </tr>
                        <?php
                    } // for loop lõpp
                    ?>
                </tbody>
            </table>
            <?php

        } else {
            echo "<h4>Viga<h4>";
            echo "<p>Postitusi ei leitud</p>";
        }
        ?> 
    
    
    </div>
</div>