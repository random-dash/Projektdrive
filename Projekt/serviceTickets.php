<?php
  include "includes/nav.php";

  

  include 'includes/dbaccess.php';
  include 'includes/functions.php';

?>

<body class="bg-dark">

<div class="row justify-content-center m-3">
  <?php 

    $sql = "SELECT * FROM tickets ORDER BY time DESC";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("location: ../index.php?error=statementfailed");
      exit();
    }
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);



    while($row = mysqli_fetch_assoc($result)){
      echo "<div class='card bg-light mb-3' style='width: 20rem;'>
          <img src='".$row['pic']."' class='card-img-top' alt='...'>
            <div class='card-body'>
                <h5 class='card-title'>".$row['title']."</h5>
              <p class='card-text'>".$row['txt']."</p>
            </div>
            <ul class='list-group list-group-flush'>";

            if($row['status'] == 'offen'){
                echo "<li class='list-group-item bi-stopwatch text-primary'> ".$row['status']."</li>";
            }else if($row['status'] == 'erfolgreich geschlossen'){
                echo "<li class='list-group-item bi-check-all text-success'> ".$row['status']."</li>";
            }else if($row['status'] == 'erfolglos geschlossen'){
                echo "<li class='list-group-item bi-emoji-frown text-danger'> ".$row['status']."</li>";
            }
            if($row["status"] != 'erfolgreich geschlossen' && (isset($_SESSION["position"]) && $_SESSION["position"] == 'service')){
            echo "
                <li class='list-group-item'><form action='includes/updateTicket.php' method='POST'>
                    <input type='hidden' name='id' value='".$row['userID']."'>
                    <button type='submit' name='suClose' class='btn btn-success w-100'><i class='bi bi-check-all'></i> Erfolgreich schließen</button>
                </form>
                </li>";
            }
            if($row["status"] != 'erfolglos geschlossen' && (isset($_SESSION["position"]) && $_SESSION["position"] == 'service')){
            echo "
                <li class='list-group-item'><form action='includes/updateTicket.php' method='POST'>
                    <input type='hidden' name='id' value='".$row['userID']."'>
                    <button type='submit' name='faClose' class='btn btn-danger w-100'><i class='bi bi-emoji-frown'></i> Erfolglos schließen</button>
                </form>
                </li>";
            }
            if($row["status"] != 'offen' && (isset($_SESSION["position"]) && $_SESSION["position"] == 'service')){
            echo "
                <li class='list-group-item'><form action='includes/updateTicket.php' method='POST'>
                    <input type='hidden' name='id' value='".$row['userID']."'>
                    <button type='submit' name='open' class='btn btn-primary w-100'><i class='bi bi-emoji-frown'></i> öffnen</button>
                </form>
                </li>";
            }
            echo "
            </ul>
            <div class='card-footer'>
              <p class='card-text'><small class='text-info'>Zuletzt bearbeitet am ".$row['time']." Erstellt von Benutzer ".getUsername($row["userID"])."</small></p>
            </div>
          </div>";
    }
  
  ?>