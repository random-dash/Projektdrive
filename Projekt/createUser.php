
<html>
    <head>
        <title>HOME</title>

        <?php
            include "includes/nav.php";
        ?>

    <div class="row h-100">
        <div class="col bg-dark d-flex align-items-center justify-content-center">
            <img class="rounded-3" height="400" width="400" src="img/logo1.png" alt="logo">
        </div>
        <div class="col bg-light d-flex align-items-center justify-content-center">
            <div class="w-75 p-3 rounded-3" id="loginregbox">
                <p class="display-4 text-lg-center">Anlegen</p>
                <form action="includes/register.php" class="needs-validation" method="POST">
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <input type="text" class="form-control" id="anrede" placeholder="Anrede" name="anrede" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="vorname" placeholder="Vorname" name="vorname" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="nachname" placeholder="Nachname" name="nachname" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="username" placeholder="Benutzername" name="username" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                        </div>
                        

                        <div class="form-group">
                            <input type="password" class="form-control" id="pwd" placeholder="Passwort" name="pwd" required>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" id="confpassword" placeholder="Passwort bestätigen" name="confpassword" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control form-control" name="position">
                                <option value="Rolle" selected disabled>Rolle</option>
                                <option value="admin">Administrator</option>
                                <option value="service">Techniker</option>
                                <option value="guest">Besucher</option>
                            </select>
                        </div>
                    
                    </div>
                    </div>
                    <div class="row d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-dark w-50" name="submit">Anlegen</a>
                    </div>
                </form>


            </div>
    <?php 
        if(isset($_GET["error"])){
            if($_GET["error"] == "invalidusername"){
                echo "<p>Benutzername darf nur aus Buchtstaben und Zahlen bestehen!</p>";
            }else if($_GET["error"] == "passwordsnotmatching"){
                echo "<p>Passwörter stimmen nicht überein!</p>";
            }else if($_GET["error"] == "usernamealreadyexists"){
                echo "<p>Dieser Benutzername existiert bereits!</p>";
            }else if($_GET["error"] == "none"){
                echo "<p>Sie haben sich erfolgreich registriert!</p>";
            }else if($_GET["error"] == "statementfailed"){
                echo "<p>Etwas hat nicht funktioniert, versuchen Sie es später nocheinmal!</p>";
            }else if($_GET["error"] == "geschafft"){
                echo "<p>Du hast dich erfolgreich eingeloggt</p>";
            }else if($_GET["error"] == "wronglogin"){
                echo "<p>Dieser Benutzer ist uns nicht bekannt!</p>";
            }
        }
?>
            </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</html>