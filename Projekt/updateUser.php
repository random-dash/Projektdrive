<?php

include 'includes/dbaccess.php';
include 'includes/functions.php';

$id = $_POST["id"];

if(isset($_POST["deactivate"])){

    $sql = "UPDATE user SET status = 'inactive' WHERE ID = ?;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("location: ../index.php?error=statementfailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    header("location: userlist.php?error=NONE");
    exit();
}else if(isset($_POST["activate"])){

    $sql = "UPDATE user SET status = 'active' WHERE ID = ?;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("location: ../index.php?error=statementfailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    header("location: userlist.php?error=NONE");
    exit();
}else if(isset($_POST["update"])){

    $sql = "SELECT * FROM user WHERE ID = ?;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("location: ../index.php?error=statementfailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
}
?>
<html>
    <head>

        <?php
            include "includes/nav.php";
        ?>

    <div class="row h-100">
        <div class="col bg-dark d-flex align-items-center justify-content-center">
            <img class="rounded-3" height="400" width="400" src="img/logo1.png" alt="logo">
        </div>
        <div class="col bg-light d-flex align-items-center justify-content-center">
            <div class="w-75 p-3 rounded-3" id="loginregbox">
                <p class="display-4 text-lg-center">Profil bearbeiten</p>
                <form action="includes/updateuser.php" class="needs-validation" method="POST">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="anrede">Anrede</label>
                                <input type="text" class="form-control border border-secondary" id="anrede" value="<?php echo $row["anrede"]; ?>" name="anrede" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="vorname">Vorname</label>
                                <input type="text" class="form-control border border-secondary" id="vorname" value="<?php echo $row["vorname"]; ?>" name="vorname" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="nachname">Nachname</label>
                                <input type="text" class="form-control border border-secondary" id="nachname" value="<?php echo $row["nachname"]; ?>" name="nachname" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="username">Benutzername(nicht veränderbar)</label>
                                <input type="text" name="username" class="form-control border border-secondary" id="username" value="<?php echo $row["username"]; ?>"  readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="email">E-Mail</label>
                                <input type="email" class="form-control border border-secondary" id="email" value="<?php echo $row["email"]; ?>" name="email" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="newpassword">Neues Passwort</label>
                                <input type="password" class="form-control border border-secondary" id="newpassword" name="newpassword" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="confpassword">Passwort bestätigen</label>
                                <input type="password" class="form-control border border-secondary" id="confpassword" name="confpassword" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="position">Position</label>
                                <select class="form-control form-control border border-secondary" name="position">
                                    <option value="<?php echo $row["position"]; ?>" selected readonly><?php echo $row["position"]; ?></option>
                                    <option value="admin">Administrator</option>
                                    <option value="service">Techniker</option>
                                    <option value="guest">Besucher</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="row d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-dark w-50" name="submit">Speichern</a>
                    </div>
                </form>


            </div>

            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</html>