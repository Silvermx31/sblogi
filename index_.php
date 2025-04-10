<?php
include("include/settings.php");
include("include/mysqli.php");
$db = new Db();
?>

<?php
$sql = "SELECT *, DATE_FORMAT(added, '%d.%m.%Y %H:%i:s') AS estonia FROM blog ORDER BY added DESC LIMIT 3";
$data = $db->dbGetArray($sql);
//$db->show($data);   //test

?>


<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minu Blogi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index_.php">Avaleht</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index_.php">Avaleht</a></li>
                    <li class="nav-item"><a class="nav-link" href="index_.php?page=blog">Blogi</a></li>
                    <li class="nav-item"><a class="nav-link" href="index_.php?page=contact">Kontakt</a></li>
                    <li class="nav-item"><a class="nav-link" href="index_.php?page=post_add">Lisa</a></li>
                    <li class="nav-item"><a class="nav-link" href="index_.php?page=post_edit">Muuda</a></li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container mt-4">
        <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'] . ".php";

                if (file_exists($page)) {
                    include($page);
                } else {
                    echo "<h2>Lehte ei leitud!</h2>";
                }
            } else {
        ?>
                <h1> Tere, Minu nimi on Silver ja see on minu Blogi.</h1>
                <p>Siin ma jagan enda elust igasuguseid huvitavaid mõtteid ja räägin igapäevaelust.</p>

                <div class="container mt-5">
                    <h2 class="text-center mb-4">Hiljutised postitused</h2>
                    <div class="row">
                        <?php
                        if($data !== false) {
                            foreach($data as $key=>$val) {
                                ?>
                                <!-- Postitus 1 -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="<?php echo $val['photo']?>" class="card-img-top" alt="Uus bmw">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $val['heading']; ?></h5>
                                            <p class="card-text"><?php echo $val['preamble']; ?></p>
                                            <a href="?page=post&sid=<?= $val['id'];?>" class="btn btn-primary">Loe edasi</a>      
                                            <?php
                                            $tags = array_map('trim',explode(",", $val['tags'])); //tükelda sildid komast     
                                            //$db->show($tags); //test
                                            $links = [];
                                            foreach($tags as $tag) {
                                                $safeTag = htmlspecialchars($tag);
                                                $links[] = "<a href=''>{$safeTag}</a>";  //lisa listi
                                            }
                                            $result = implode(", ", $links);
                                            echo $result; //väljasta tulemus
                                            ?>                                
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
            }
                            ?>


                       
                        


                    </div> 
                </div> 
                
                
                                
                                
                                
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Minu Blogi. Kõik õigused kaitstud.</p>
    </footer>

</body>
</html>
