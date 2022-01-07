<?php 
    session_start();
?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <!--link rel="stylesheet" href="css/style.css"!-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="img/logo1.png">
    </head>
    <body style="padding-top: 56px; overflow-x: hidden!important">
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top">
         
    
    <a class="navbar-brand" disabled>A-Square</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-dark bi-newspaper" href="news.php"> News</a>
            </li>
            
            
            
        <?php
        if(isset($_SESSION["position"]) && ($_SESSION["position"] == 'service' || $_SESSION["position"] == 'admin')){
            echo "
                <li class='nav-item'> 
                    <a class='nav-link text-dark bi-ticket-detailed' href='serviceTickets.php'> Tickets</a>
                </li>";
        }
        if(isset($_SESSION["position"]) && $_SESSION["position"] == 'guest'){
            echo "
                <li class='nav-item'> 
                    <a class='nav-link text-dark bi-ticket-detailed' href='tickets.php'> Meine Tickets</a>
                </li>";
        }
            if(isset($_SESSION["id"])){
                echo "
                <li class='nav-item'> 
                <a class='nav-link text-dark bi-person' href='profile.php'> Profil</a>
            </li>"; 
            }
            
            if(isset($_SESSION["position"]) && $_SESSION["position"] == 'admin'){
                echo "<li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle text-dark bi-people' href='#' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-expanded='false'>
                    Benutzerverwaltung
                </a>
                <div class='dropdown-menu bg-secondary' aria-labelledby='navbarDropdownMenuLink'>
                    <a class='dropdown-item text-dark bi-person-plus' href='createUser.php'> Profil anlegen</a>
                    <a class='dropdown-item text-dark bi-person-lines-fill' href='userlist.php'> Benutzerliste</a>
                </div>
            </li>";
            }
        ?>

        </ul>

        
        
    
        <?php
                if(isset($_SESSION["id"])){
                }else{
                    echo "
                        <a class='nav-link text-dark bi-box-arrow-in-left' href='index.php'>Login</a>
                        ";
            }?>
        <?php
            if(isset($_SESSION["id"])){
                echo "<span class='navbar-text'> Willkommen, ".$_SESSION["anrede"] . "&nbsp;" . "<span class='text-warning'>". $_SESSION["vorname"] . "&nbsp;" . $_SESSION["nachname"] ." </span></span>";
            }
        ?>
    </div>
</nav>

<footer class="fixed-bottom">
<ul class="nav bg-secondary w-25 justify-content-center">
    <li class="nav-item">
        <a class="nav-link text-dark bi-question-square" href="hilfe.php"> Hilfe</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-dark bi-building" href="impressum.php"> Impressum</a>
    </li>
    <?php 
            if(isset($_SESSION["id"])){
                echo "
                    <li class='nav-item'>
                        <a class='nav-link text-dark bi-box-arrow-right' href='includes/logout.php'> Logout</a>
                    </li>";
            }?>
</ul>
        </footer>
