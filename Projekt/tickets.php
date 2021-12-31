<?php
    include 'includes/dbaccess.php';
  include "includes/nav.php";
  include "includes/functions.php";
?>

<body class="bg-dark">

<div class="row justify-content-center m-3">
  <?php 

    $sql = "SELECT * FROM tickets  WHERE userID = ?;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("location: ../index.php?error=statementfailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $_SESSION["id"]);
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
                
            echo "</ul>
            <div class='card-footer'>
              <p class='card-text'><small class='text-muted'>Zuletzt bearbeitet am ".$row['time']."</small> </p>
            </div>
          </div>";
    }

  ?>
<div class='card bg-light mb-3' style='width: 20rem;'>
    <img src='img/ticket.png' class='card-img-top' alt='...'>
      <div class='card-body'>
        <h5 class='card-title'>Neues Ticket</h5>
        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>
          Hinzufügen
        </button>
      </div>
    </div>
</div>






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