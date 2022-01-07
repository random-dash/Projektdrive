<?php
    include 'includes/dbaccess.php';
  include "includes/nav.php";
  include "includes/functions.php";
?>

<body class="bg-dark">

<div class="row justify-content-center m-3">
  <table class='table table-striped table-dark table-hover'>
  <thead>
    <tr>
      <th scope="col">E-Mail</th>
      <th scope="col">Betreff</th>
      <th scope="col">Datum</th>
      <th scope="col">Status</th>
      <th scope="col">Aktion</th>
    </tr>
  </thead>
  <tbody class="justify-content-center">
    <tr>
        <td colspan="2">Sortieren nach:</td>
        <td colspan="4">
          <form action='serviceTickets.php' method="POST">
            <input class="btn btn-info" value='Alle' type='submit' name='time'>
            <input class="btn btn-primary" value='Offen' type='submit' name='offen'>
            <input class="btn btn-success" value='Erfolgreich geschlossen' type='submit' name='suclose'>
            <input class="btn btn-danger" value='Erfolglos geschlossen' type='submit' name='faclose'>
          </form>
        </td>
    </tr>
  <?php 
  if(isset($_POST['offen']) || isset($_POST['suclose']) || isset($_POST['faclose'])){
    $sql = "SELECT * FROM tickets WHERE status = ? ORDER BY time DESC;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("location: tickets.php?error=statementfailed");
      exit();
    }
    if(isset($_POST['offen'])){
      $status = 'offen';
    }else if(isset($_POST['suclose'])){
      $status = 'erfolgreich geschlossen';
    }else{
      $status = 'erfolglos geschlossen';

    }

    mysqli_stmt_bind_param($stmt, "s", $status);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  }else{
    $sql = "SELECT * FROM tickets ORDER BY time DESC;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("location: tickets.php?error=statementfailed");
      exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  }

  while($row = mysqli_fetch_assoc($result)){
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

    echo "<tr>
    <form action='ticketInfo.php' method='POST'>
        <input type='hidden' name='ticketID' value='".$row['ticketID']."'>
        <td class='text-info'>".$rowuser['email']."</td>
        <td>".$row['title']."</td>
        <td>".$row['time']."</td>
        ";
        if($row['status'] == 'offen'){
          echo "<td class=' bi-stopwatch text-primary'> ".$row['status']."</td>";
      }else if($row['status'] == 'erfolgreich geschlossen'){
          echo "<td class=' bi-check-all text-success'> ".$row['status']."</td>";
      }else if($row['status'] == 'erfolglos geschlossen'){
          echo "<td class=' bi-emoji-frown text-danger'> ".$row['status']."</td>";
      }echo " 
        <td><input type='submit' name='getinfo' value='Info' class='btn btn-primary w-50'></form>";
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
          
        echo "
    
  </tr>
      ";
    }

  ?>
</table>






<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Neues Ticket erstellen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="upload.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="fileToUpload">Wählen Sie ein Bild aus:</label>
            <input class="form-control-file mb-1" type="file" name="fileToUpload" id="fileToUpload">
            <label for="titel">Betreff</label>
            <input id="titel" class="form-control" name="title">
            <label for="textarea">Beschreiben Sie ihr Problem</label>
            <textarea id="textarea" class="form-control" name="text" rows="5"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Speichern" name="createTicket">
      </div>

      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>