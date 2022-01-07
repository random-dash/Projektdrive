<?php
    include 'includes/dbaccess.php';
    include "includes/nav.php";
    include "includes/functions.php";

    $ticketID = $_POST["ticketID"];
    $sql = "SELECT * FROM tickets WHERE ticketID = ?;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: tickets.php?error=statementfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $ticketID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $sqluser = "SELECT * FROM user WHERE ID = ?;";
    $stmtuser = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmtuser, $sqluser)){
      header("location: ../index.php?error=statementfaileduser");
      exit();
    }

    mysqli_stmt_bind_param($stmtuser, "s", $row["userID"]);
    mysqli_stmt_execute($stmtuser);
    $resultuser = mysqli_stmt_get_result($stmtuser);
    $rowuser = mysqli_fetch_assoc($resultuser);

    

    $sqlnote = "SELECT * FROM notes WHERE ticketID = ?;";
    $stmtnote = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmtnote, $sqlnote)){
      header("location: ../index.php?error=statementfaileduser");
      exit();
    }

    mysqli_stmt_bind_param($stmtnote, "s", $row["ticketID"]);
    mysqli_stmt_execute($stmtnote);
    $resultnote = mysqli_stmt_get_result($stmtnote);
?>

<body class="bg-dark">





  <div class="card mt-3" style="background-color: 	#b3b3b3;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="<?php echo $row["pic"] ?>" style="max-width: 500px; max-height: 500px;" >
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title"><?php echo $row["title"] ?></h5>
        <p class="card-text"><?php echo $row["txt"] ?></p>
        <p class="card-text"><small class="text-dark"><?php echo $row["time"] ?> von <?php echo $rowuser["email"] ?></small></p>
      </div>
    </div>
    <div class="col-md-2 border-left border-dark">
        <div class="card-body">
        <h5 class="card-title">Status</h5>

        <?php 
            if($row['status'] == 'offen'){
                echo "<p class='bi-stopwatch h4 text-info'> ".$row['status']."</p>";
            }else if($row['status'] == 'erfolgreich geschlossen'){
                echo "<p class='bi-check-all h4 text-success'> ".$row['status']."</p>";
            }else if($row['status'] == 'erfolglos geschlossen'){
                echo "<p class='bi-emoji-frown h4 text-danger'> ".$row['status']."</p>";
            }
            if($row["status"] != 'erfolgreich geschlossen' && (isset($_SESSION["position"]) && $_SESSION["position"] == 'service')){
                echo "
                    <form action='includes/updateTicket.php' method='POST'>
                        <input type='hidden' name='id' value='".$row['ticketID']."'>
                        <button type='submit' name='suClose' class='btn btn-success w-50'><i class='bi bi-check-all'></i> Erfolgreich schließen</button>
                    </form>
                    ";
                }
                if($row["status"] != 'erfolglos geschlossen' && (isset($_SESSION["position"]) && $_SESSION["position"] == 'service')){
                echo "
                    <form action='includes/updateTicket.php' method='POST'>
                        <input type='hidden' name='id' value='".$row['ticketID']."'>
                        <button type='submit' name='faClose' class='btn btn-danger w-50'><i class='bi bi-emoji-frown'></i> Erfolglos schließen</button>
                    </form>
                    ";
                }
                if($row["status"] != 'offen' && (isset($_SESSION["position"]) && $_SESSION["position"] == 'service')){
                echo "
                    <form action='includes/updateTicket.php' method='POST'>
                        <input type='hidden' name='id' value='".$row['ticketID']."'>
                        <button type='submit' name='open' class='btn btn-primary w-50'><i class='bi bi-emoji-frown'></i> öffnen</button>
                    </form>
                    ";}
        ?>
    </div>
    </div>
    
  </div>
  <ul  class="list-group list-group-flush">
    <li style="background-color: 	#b3b3b3;"  class="list-group-item h5 text-center">Notizen</li>

    <?php 
        while($rownote = mysqli_fetch_assoc($resultnote)){
            $sqlsender = "SELECT * FROM user WHERE ID = ?;";
            $stmtsender = mysqli_stmt_init($connect);

            mysqli_stmt_prepare($stmtsender, $sqlsender);
            mysqli_stmt_bind_param($stmtsender, "s", $rownote["userID"]);
            mysqli_stmt_execute($stmtsender);
            $resultsender = mysqli_stmt_get_result($stmtsender);
            $rowsender = mysqli_fetch_assoc($resultsender);

    
    echo "<li style='background-color: 	#b3b3b3;' class='list-group-item'>
    <div class='row'>
            <div class='col-md-2'>".$rowsender['nachname'].":</div>
            <div class='col-md-8'>".$rownote['note']."</div>
            <div class='col-md-2'>".$rownote['time']."</div>
           </div> 
        </li>";
        }
    
    ?>

  </ul>
    <form action="includes/note.php" method="POST">
    <div style="background-color: #b3b3b3;" class="card-footer">
        <div class="input-group input-group-lg has-validation w-100">
            <div class="input-group-prepend">
                <span style='background-color: 	#b3b3b3;'  class="input-group-text border-dark text-dark">Notiz hinzufügen</span>
            </div>
            <input type="hidden" name="ticketID" value="<?php echo $row["ticketID"] ?>" readonly>
            <textarea type="text" style="background-color: 	#b3b3b3;" class="form-control border-dark" name="note" required></textarea>
            <div class="input-group-append" id="button-addon1">
                <button type="submit" class="btn btn-outline-dark btn-primary bi bi-send"></button>
            </div>
            
        </div>

    </div>
    </form> 
</div>

