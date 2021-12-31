
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
            <div class="p-3 w-50" id="loginregbox"> 
                <p class="display-4 text-lg-center">Login</p>
                <form action="includes/login.php" class="needs-validation" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="log" placeholder="Email/Benutzername" name="log" required>
                    </div>
    
                    <div class="form-group">
                        <input type="password" class="form-control" id="logpwd" placeholder="Passwort" name="logpwd" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark m-2" name="submit">Anmelden</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</html>