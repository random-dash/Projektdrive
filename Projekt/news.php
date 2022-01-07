<?php
  include "includes/nav.php";

  

  include 'includes/dbaccess.php';

?>

<body class="bg-dark">


<div class="row justify-content-center m-3">
<?php 
  if(isset($_SESSION["position"]) && $_SESSION["position"] == 'admin'){
    echo "<div class='card bg-light mb-3' style='width: 12rem; height: 20rem'>
    <img src='img/add.png' class='card-img-top' alt='...'>
      <div class='card-body'>
        <h5 class='card-title'>Neuer Beitrag</h5>
        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>
          Hinzufügen
        </button>
      </div>
    </div>";
  }

?>
  <?php 

    $sql = "SELECT * FROM newsimg  ORDER by time DESC;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("location: ../index.php?error=statementfailed");
      exit();
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_assoc($result)){
      echo "<div class='card bg-light m-1 mb-3' style='width: 20rem;'>
          <img src='".$row['filepath']."' class='card-img-top' alt='...'>
            <div class='card-body'>
              <p class='card-text'>".$row['txt']."</p>
            </div>";
            if(isset($_SESSION["position"]) && $_SESSION["position"] == 'admin'){
              echo "<ul class='list-group list-group-flush'>
              <li class='list-group-item'><form action='includes/updatePost.php' method='POST'>
              <input type='hidden' name='id' value='".$row['ID']."'>
              <button type='submit' name='updatePost' class='btn btn-danger w-100'><i class='bi bi-trash'></i> Löschen</button>
              </form>
              </li>
              </ul>";
            }
            echo "<div class='card-footer'>
              <p class='card-text'><small class='text-muted'>Erstellt am ".$row['time']."</small></p>
            </div>
          </div>";
    }
  
  ?>

</div>






<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Neuen Beitrag hinzufügen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="upload.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="fileToUpload">Wählen Sie ein Bild aus:</label>
            <input class="form-control-file" type="file" name="fileToUpload" id="fileToUpload">
            <textarea class="form-control" name="text" placeholder="Geben einen Text ein" rows="5"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Speichern" name="submit">
      </div>

      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
