<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$db->show($_POST);     // näita vormi andmeid
    //$db->show($_FILES);       // näita faili infot

    // tekstiväljade olemasolu ja tühjuse kontroll
    $heading = trim($_POST['heading'] ?? '');
    $preamble = trim($_POST['preamble'] ?? '');
    $context = trim($_POST['context'] ?? '');
    $tags = trim($_POST['tags'] ?? '');

    $errors = [];   //Tühja listi loomine

    if ($heading === '') {$errors[] = "Pealkiri on kohustuslik"; }
    if ($preamble === '') {$errors[] = "Sissejuhatus on kohustuslik"; }
    if ($context === '') {$errors[] = "Põhitekst on kohustuslik"; }
    if ($tags === '') {$errors[] = "Kategooria(d) on kohustuslik"; }

    //Faili olemasolu ja kontroll
    if(!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Pildi üleslaadimine ebaõnnestus või on puudu";
    } else {
        $image = $_FILES['photo'];
        // Filinime normaliseerimine
        $origName = basename($image['name']);   //ainult nimi.laiend (flower.jpg)
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));

        //$db->show($image).'<br>';
        //echo $origName.'<br>';
        //echo $ext.'<br>';
        $allowed = ['jpg', 'jpge', 'png', 'gif', 'webp'];
        if(!in_array($ext, $allowed)) {
            $errors[] = "Lubatud on ainult pildifailid: " . implode(', ', $allowed);
        }

        $normalizedName = preg_replace('/[^a-z0-9_\-\.]/i', '_', pathinfo($origName, PATHINFO_FILENAME));   //otsib ja asendab nimes asju, kõik mis keelatud, asendatakse
        $filename = $normalizedName . '-' . time() . '.' . $ext;        // 2 sama nimega faili ette lisatakse aeg

    }

    if(empty($errors)) {
        $heading = htmlspecialchars($heading);
        $preamble = htmlspecialchars($preamble);
        $contex = htmlspecialchars($context);
        $tags = htmlspecialchars($tags);

        $uploadPath = UPLOAD_IMAGES . $filename; // images/lilled.png
        move_uploaded_file($image['tmp_name'], $uploadPath); // tõsta tmp kaustast soovitud kohta

        //Tee SQL lause andmebaasi lisamiseks
        $sql = "INSERT INTO blog (heading, preamble, context, tags, photo) VALUES (
                '".$db->dbFix($heading)."',
                '".$db->dbFix($preamble)."',
                '".$db->dbFix($context)."',
                '".$db->dbFix($tags)."',
                '".$db->dbFix($uploadPath)."')";
        //echo $sql;  //Väljasta sql lause testiks
        if($db->dbQuery($sql)) {
            echo "<div class='alert alert-success'>Postitus lisatud</div>";
        }else {
            echo "<div class='alert alert-danger'>Postitus ei ole lisatud</div>";
        }
        
    } else {
        //Leiti vigu $errors
        echo "<div class='alert alertdanger'><ul>";
        foreach($errors as $error) {
            echo "<li>".htmlspecialchars($error)."</li>";
        }
        echo "</ul></div>";

        
    }



}
?>


<div class="container mt-5">
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="card p-2 shadow">
            <h2 class="text-center">Uus postitius</h2>
            <form action="?page=post_add" method="post" enctype="multipart/form-data">
                <div class="mp-3">
                    <label for="heading" class="form-label.fw-bold">Pealkiri</label>
                    <input type="text" name="heading" id="heading" class="form-control" required>
                </div>

                <div class="mp-3">
                    <label for="preamble" class="form-label.fw-bold">Sissejuhatus</label>
                    <textarea name="preamble" id="preamble" class="form-control" rows="3" maxlenght="200" required></textarea>
                </div>

                <div class="mp-3">
                    <label for="context" class="form-label.fw-bold">Põhitekst</label>
                    <textarea name="context" id="context" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mp-3">
                    <label for="tags" class="form-label.fw-bold">Sildid</label>
                    <input type="text" name="tags" id="tags" class="form-control" maxlength="50" placeholder="Eralda komadega" required>
                </div>

                <div class="mp-3">
                    <label for="photo" class="form-label.fw-bold">Pilt</label>
                    <input type="file" name="photo" id="photo" class="form-control" required>
                </div>
                
                <div class="d-flex justify-content-between">
                    <button type="reset" class="btn btn-danger">Tühjenda vorm</button>
                    <button type="submit" class="btn btn-success">Sisesta postitus</button>
                </div>
            </form>
        </div>
    </div>
</div>
