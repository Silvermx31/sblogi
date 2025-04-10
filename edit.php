<?php
$data = false;
if(isset($_GET['sid']) && !empty($_GET['sid']) && is_numeric($_GET['sid'])) {
    // see on muutmiseks võetud kirje
    $id = (int)$_GET['sid'];
    $sql = "SELECT * FROM blog WHERE id = $id";
    //echo $sql;  //test
    $data = $db->dbGetArray($sql);

    if(isset($_GET['update']) && $_GET['update'] == 'true' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        //$db->show($_POST); -TEST
        //$db->show($_FILES); - TEST
        // tekstiväljade olemasolu ja tühjuse kontroll
        $heading = trim($_POST['heading'] ?? '');
        $preamble = trim($_POST['preamble'] ?? '');
        $context = trim($_POST['context'] ?? '');
        $tags = trim($_POST['tags'] ?? '');
        $oldPhoto = $_POST['photo'];
        $photoUpdate = '';

    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        
    }
    }


}

?>
<div class="container mt-5">
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <?php
        if($data !== false) {
            $data = $data[0];
            ?>
            <div class="card p-2 shadow">
                <h2 class="text-center">Muuda postitust</h2>
                <form action="?page=edit&sid=<?= $data['id']; ?>&update=true" method="post" enctype="multipart/form-data">
                    <div class="mp-3">
                        <label for="heading" class="form-label.fw-bold">Pealkiri</label>
                        <input type="text" name="heading" <?= $db->htmlvalue('heading', $data); ?> id="heading" class="form-control" required><?= $db->htmlTextContent('heading', $data) ?>
                    </div>

                    <div class="mp-3">
                        <label for="preamble" class="form-label.fw-bold">Sissejuhatus</label>
                        <textarea name="preamble" id="preamble" class="form-control" rows="3" maxlenght="200" required><?= $db->htmlTextContent('preamble', $data) ?></textarea>
                    </div>

                    <div class="mp-3">
                        <label for="context" class="form-label.fw-bold">Põhitekst</label>
                        <textarea name="context" id="context" class="form-control" rows="3" required><?= $db->htmlTextContent('context', $data) ?></textarea>
                    </div>

                    <div class="mp-3">
                        <label for="tags" class="form-label.fw-bold">Sildid</label>
                        <input type="text" name="tags" <?= $db->htmlvalue('tags', $data) ?> id="tags" class="form-control" maxlength="50" placeholder="Eralda komadega" required>
                    </div>

                    <div class="mp-3">
                        <label for="photo" class="form-label.fw-bold">Pilt</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <input type="hidden" name="OldPhoto" <?= $db->htmlValue('photo', $data); ?>>
                        <button type="reset" class="btn btn-warning">Tühjenda vorm</button>
                        <button type="submit" class="btn btn-primary">Muuda postitust</button>
                    </div>
                </form>
            </div>


            <?php

        } else {
            echo "Sobivat postitust ei leitud";
        }


        ?>
        
    </div>
</div>
