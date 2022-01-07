<?php
  include 'includes/dbaccess.php';
  include "includes/nav.php";
?>

<body class="bg-dark">
<?php 
      if(isset($_GET["error"])){
          if($_GET["error"] == "updated"){
              echo "<div class='alert alert-success' role='alert'>
                  Profil erfolgreich aktualisiert!
            </div>";
          }
          if($_GET["error"] == "passwordsnotmatching"){
              echo "<div class='alert alert-danger' role='alert'>
                  Passwörter stimmen nicht überein!
            </div>";
          }
      }
?>
<table class="table table-striped table-dark table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Benutzername</th>
      <th scope="col">Anrede</th>
      <th scope="col">Vorname</th>
      <th scope="col">Nachname</th>
      <th scope="col">E-Mail</th>
      <th scope="col">Position</th>
      <th scope="col">Status</th>
      <th scope="col">Aktion</th>
    </tr>
  </thead>
  <tbody class="justify-content-center"><?php
        $sql = "SELECT * FROM user  ORDER BY ID;";
        $stmt = mysqli_stmt_init($connect);

        if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=statementfailed");
        exit();
        }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while($row = mysqli_fetch_assoc($result)){
            if($row['status'] == 'active'){
                $statustext = "text-success";
            }else{
                $statustext = "text-danger";
            }
            echo "
            <tr>
                <form action='updateUser.php' method='POST'>
                    <th scope='row'><input type='hidden' name='id' value='".$row['ID']."'>".$row['ID']."</th>
                    <td>".$row['username']."</td>
                    <td>".$row['anrede']."</td>
                    <td>".$row['vorname']."</td>
                    <td>".$row['nachname']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['position']."</td>
                    <td><i class='bi ".$statustext." bi-circle-fill'></i> ".$row['status']."</td>

                    <td>";
                    if($row['status'] == 'active'){
                        echo "<button type='submit' name='deactivate' class='btn btn-danger w-50'><i class='bi bi-person-dash'></i> Deaktivieren</button>";
                    }else{
                        echo "<button type='submit' name='activate' class='btn btn-success w-50'><i class='bi bi-person-dash'></i> Aktivieren</button>";
                    }
                    echo "<button type='submit' name='update' class='btn btn-primary w-50'><i class='bi bi-pencil-square'></i> Bearbeiten</button></td>
                </form>
            </tr>";
            }?>
    
  </tbody>
</table>








<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
