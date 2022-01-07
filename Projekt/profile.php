
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
                <p class="display-4 text-lg-center">Profil</p>
                <form action="includes/profileinc.php" class="needs-validation " method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="anrede">Anrede</label>
                            <input type="text" class="form-control border border-secondary" id="anrede" value="<?php echo $_SESSION["anrede"]; ?>" name="anrede" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="email">E-Mail</label>
                            <input type="email" class="form-control border border-secondary" id="email" value="<?php echo $_SESSION["email"]; ?>" name="email" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="vorname">Vorname</label>
                            <input type="text" class="form-control border border-secondary" id="vorname" value="<?php echo $_SESSION["vorname"]; ?>" name="vorname" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="pwd">Altes Passwort</label>
                            <input type="password" class="form-control border border-secondary" id="pwd" name="pwd" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nachname">Nachname</label>
                            <input type="text" class="form-control border border-secondary" id="nachname" value="<?php echo $_SESSION["nachname"]; ?>" name="nachname" required>
                        </div>    
                        <div class="form-group col-md-6">
                            <label class="form-label" for="newpassword">Neues Passwort</label>
                            <input type="password" class="form-control border border-secondary" id="newpassword" name="newpassword" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="username">Benutzername(nicht veränderbar)</label>
                            <input type="text" name="username" class="form-control border border-secondary" id="username" value="<?php echo $_SESSION["username"]; ?>"  readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="confpassword">Passwort bestätigen</label>
                            <input type="password" class="form-control border border-secondary" id="confpassword" name="confpassword" required>
                        </div>
                    </div>

                    <!--div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="anrede">Anrede</label>
                                <input type="text" class="form-control border border-secondary" id="anrede" value="<?php echo $_SESSION["anrede"]; ?>" name="anrede" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="vorname">Vorname</label>
                                <input type="text" class="form-control border border-secondary" id="vorname" value="<?php echo $_SESSION["vorname"]; ?>" name="vorname" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="nachname">Nachname</label>
                                <input type="text" class="form-control border border-secondary" id="nachname" value="<?php echo $_SESSION["nachname"]; ?>" name="nachname" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="username">Benutzername(nicht veränderbar)</label>
                                <input type="text" name="username" class="form-control border border-secondary" id="username" value="<?php echo $_SESSION["username"]; ?>"  readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="email">E-Mail</label>
                                <input type="email" class="form-control border border-secondary" id="email" value="<?php echo $_SESSION["email"]; ?>" name="email" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="pwd">Altes Passwort</label>
                                <input type="password" class="form-control border border-secondary" id="pwd" name="pwd" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="newpassword">Neues Passwort</label>
                                <input type="password" class="form-control border border-secondary" id="newpassword" name="newpassword" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="confpassword">Passwort bestätigen</label>
                                <input type="password" class="form-control border border-secondary" id="confpassword" name="confpassword" required>
                            </div>
                        </div> 
                    </div!-->
                    <div class="row d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-dark w-50" name="submit">Speichern</a>
                    </div>
                </form>

<?php 
        if(isset($_GET["error"])){
            if($_GET["error"] == "none"){
                echo "<div class='alert alert-success' role='alert'>
                    Profil erfolgreich aktualisiert!
              </div>";
            }
            if($_GET["error"] == "passwordsnotmatching"){
                echo "<div class='alert alert-danger' role='alert'>
                    Passwörter stimmen nicht überein!
              </div>";
            }
            if($_GET["error"] == "falsepwd"){
                echo "<div class='alert alert-danger' role='alert'>
                    Falsches Passwort angegeben!
              </div>";
            }
        }
?>
            </div>
    
            </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</html>