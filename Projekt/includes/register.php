<?php
    $inputtype = INPUT_POST;
    
    if(isset($_POST["submit"])){
        $anrede       = filter_input(type: $inputtype, var_name: 'anrede', filter: FILTER_SANITIZE_STRING);
        $vorname      = filter_input(type: $inputtype, var_name: 'vorname', filter: FILTER_SANITIZE_STRING);
        $nachname     = filter_input(type: $inputtype, var_name: 'nachname', filter: FILTER_SANITIZE_STRING);
        $username     = filter_input(type: $inputtype, var_name: 'username', filter: FILTER_SANITIZE_STRING);
        $email        = filter_input(type: $inputtype, var_name: 'email', filter: FILTER_SANITIZE_EMAIL);
        $pwd     = filter_input(type: $inputtype, var_name: 'pwd', filter: FILTER_SANITIZE_STRING);
        $confpassword = filter_input(type: $inputtype, var_name: 'confpassword', filter: FILTER_SANITIZE_STRING);
        $position   = $_POST["position"];
        

        require_once 'dbaccess.php';
        require_once 'functions.php';

        /*if(emptyInputRegister($anrede, $vorname, $nachname, $username, $email, $pwd, $confpassword) !== false){
            header("location: ../index.php?error=emptyinput");
            exit();
        }*/

        if(invalidUsername($username) !== false){
            header("location: ../index.php?error=invalidusername");
            exit();
        }

        if(invalidEmail($email) !== false){
            header("location: ../index.php?error=invalidemail");
            exit();
        }

        if(passwordMatcher($pwd, $confpassword) !== false){
            header("location: ../index.php?error=passwordsnotmatching");
            exit();
        }

        if(emailorusernameExists($connect, $username, $email) !== false){
            header("location: ../index.php?error=usernamealreadyexists");
            exit();
        }

        createUser($connect, $anrede, $vorname, $nachname, $username, $email, $pwd, $position);



    }else{
        header("location: ../index.php");
        exit();
    }
