<?php
if(isset($_GET['sid']) && is_numeric($_GET['sid'])) {
    $id=(int)$_GET['sid']; // Võtame url id väärtuse ja tehes täisarvuks
    $sql = "SELECT *, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') as adding FROM blog WHERE id = ".$id;
    $data = $db-> dbGetArray($sql);
    //$db->show($data);
    //$val = $data[0];
    //$db->show($val);

    if($data !== false) {
        $val = $data[0];
    ?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1><?php echo $val['heading']; ?></h1> 
                <p><strong>Avaldatud: </strong><?php echo $val['adding']; ?></p>
                
                <img src="<?php echo $val['photo']; ?>" class="img-fluid rounded mb-4" alt="BMW F31">
                <p class="card-text"><?php echo $val['context']; ?></p>
                <p><strong>Kategooriad:</strong> <span class="badge bg-primary">Autod</span> <span class="badge bg-secondary">BMW</span></p>

                <div class="d-flex justify-content-between mt-4">
                    <a href="index_.php?page=post2" class="btn btn-primary">Järgmine postitus ➡</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    } else {
        ?>
        <h4>Viga</h4>
        <p>Sellist postitust ei ole!</p>
        <?php
    }
} else {
    ?>
    <h4>Viga</h4>
    <p>Vigane URL</p>
    <?php
}
?>