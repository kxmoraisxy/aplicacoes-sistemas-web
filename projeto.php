
<?php
    session_start();
    include 'php/abreconexao.php';
    $sql_viagens = "SELECT COUNT(*) AS total_viagens FROM viagem";
    $sql_viagem_data = "SELECT id, partida, destino, data, condutor_id FROM viagem";

    $total_viagens = $conn->query($sql_viagens)->fetch_assoc()['total_viagens'];
    $viagem_data = $conn->query($sql_viagem_data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>EcoRide - Carpooling</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body class="w3-light-grey">

<!-- Navigation Bar -->
<div class="w3-bar w3-white w3-border-bottom w3-large">
    <a href="aboutus.html" class="w3-bar-item w3-button w3-text-green"><b><i class="fa fa-car w3-margin-right"></i>EcoRide</b></a>
    <?php
        if (isset($_SESSION["useremail"])) {
            echo "<a href='/~asw22/projeto2/php/logout.php' class='w3-bar-item w3-button w3-right w3-text-grey'><i class='fa fa-user'></i> Logout</a>";
            echo "<a href='/~asw22/projeto2/profile.php' class='w3-bar-item w3-button w3-right w3-text-grey'><i class='fa fa-user'></i> Profile</a>";
        } else {
            echo "<a href='/~asw22/projeto2/login.html' class='w3-bar-item w3-button w3-right w3-text-grey'><i class='fa fa-user'></i> Login</a>";
            echo "<a href='/~asw22/projeto2/register.html' class='w3-bar-item w3-button w3-right w3-text-grey'><i class='fa fa-user'></i> Register</a>";
        }
    ?>
</div>

<!-- Hero Section -->
<header class="hero">
    <div class="hero-content w3-center w3-text-white">
        <h1 class="w3-xxlarge">Viaje de forma económica e sustentável</h1>
        <p>Encontre uma viagem</p>
        <div class="search-box">
            <input class="w3-input w3-border" type="text" id="partida" placeholder="De">
            <input class="w3-input w3-border" type="text" id="destino" placeholder="Para">
            <button onclick="pesquisarViagens()" class="w3-button w3-green w3-block">Pesquisar</button>
        </div>
    </div>
</header>

<!-- Available Rides Section -->
<div class="w3-content w3-padding-32" style="max-width:1100px;">
    <h3 class="w3-center">Viagens disponíveis</h3>
    <div class="w3-row-padding w3-center">


        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-card w3-white">
                <div class="w3-container">
                    <h4><b>Lisboa → Porto</b></h4>
                    <p><i class="fa fa-user"></i> João Silva | <i class="fa fa-euro"></i> 15</p>
                    <button class="w3-button w3-green w3-block">Reservar</button>
                </div>
            </div>
        </div>


        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-card w3-white">
                <div class="w3-container">
                    <h4><b>Coimbra → Faro</b></h4>
                    <p><i class="fa fa-user"></i> Rodrigo Teodósio  | <i class="fa fa-euro"></i> 17</p>
                    <a href="/~asw22/projeto/profile.html" class="w3-button w3-green w3-block">Reservar</a>
                </div>
            </div>
        </div>



        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-card w3-white">
                <div class="w3-container">
                    <h4><b>Lisboa → Faro</b></h4>
                    <p><i class="fa fa-user"></i> Ana Santos | <i class="fa fa-euro"></i> 15</p>
                    <button class="w3-button w3-green w3-block">Reservar</button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Footer -->
<footer class="w3-container w3-center w3-padding-16 w3-dark-green">
    <p>EcoRide © 2025 - Compartilhe sua viagem e economize</p>
</footer>

</body>
</html>
