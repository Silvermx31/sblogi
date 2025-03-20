<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minu Blogi</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Navigatsioonimenüü -->
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
            // Määrame, millist lehte kuvada
            if (isset($_GET['page'])) {
                $page = $_GET['page'] . ".html";

                // Kontrollime, kas fail eksisteerib
                if (file_exists($page)) {
                    include($page);
                } else {
                    echo "<h2>Lehte ei leitud!</h2>";
                }
            } else {
                // Kui lehte pole määratud, kuvatakse avalehe sisu
        ?>
                <h1> Tere, Minu nimi on Silver ja see on minu Blogi.</h1>
                <p>Siin ma jagan enda elust igasuguseid huvitavaid mõtteid ja räägin igapäevaelust.</p>

                <!-- Hiljutised blogipostitused -->
                <div class="container mt-5">
                    <h2 class="text-center mb-4">Hiljutised postitused</h2>
                    <div class="row">
                        <!-- Postitus 1 -->
                        <div class="col-md-4">
                            <div class="card">
                                <img src="img/bmwf31.jpg" class="card-img-top" alt="Uus bmw">
                                <div class="card-body">
                                    <h5 class="card-title">Esimene auto</h5>
                                    <p class="card-text">Ostsin endale uue auto, kas olen sellega rahul? Autoks on 2018...</p>
                                    <a href="index_.php?page=post1" class="btn btn-primary">Loe edasi</a>                                </div>
                            </div>
                        </div>
                        <!-- Postitus 2 -->
                        <div class="col-md-4">
                            <div class="card">
                                <img src="img/bmw2.jpg" class="card-img-top" alt="Tuunisin autot">
                                <div class="card-body">
                                    <h5 class="card-title">Remont või upgrade?</h5>
                                    <p class="card-text">Mida ma kohe remontima pean hakkama?</p>
                                    <a href="index_.php?page=post2" class="btn btn-primary">Loe edasi</a>                                </div>
                            </div>
                        </div>
                        <!-- Postitus 3 -->
                        <div class="col-md-4">
                            <div class="card">
                                <img src="img/veljed.jpg" class="card-img-top" alt="Tuunisin autot">
                                <div class="card-body">
                                    <h5 class="card-title">Uued veljed?</h5>
                                    <p class="card-text">BMW Style 403M diilid</p>
                                    <a href="index_.php?page=post3" class="btn btn-primary">Loe edasi</a>                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
        <?php
            }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Jalus (Footer) -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Minu Blogi. Kõik õigused kaitstud.</p>
    </footer>

</body>
</html>
