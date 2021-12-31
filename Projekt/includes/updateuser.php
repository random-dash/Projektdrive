<?php

$inputtype = INPUT_POST;
    
    if(isset($_POST["submit"])){
        $anrede       = filter_input(type: $inputtype, var_name: 'anrede', filter: FILTER_SANITIZE_STRING);
        $vorname      = filter_input(type: $inputtype, var_name: 'vorname', filter: FILTER_SANITIZE_STRING);
        $nachname     = filter_input(type: $inputtype, var_name: 'nachname', filter: FILTER_SANITIZE_STRING);
        $username     = filter_input(type: $inputtype, var_name: 'username', filter: FILTER_SANITIZE_STRING);
        $email        = filter_input(type: $inputtype, var_name: 'email', filter: FILTER_SANITIZE_EMAIL);
        $pwd     = filter_input(type: $inputtype, var_name: 'newpassword', filter: FILTER_SANITIZE_STRING);
        $confpassword = filter_input(type: $inputtype, var_name: 'confpassword', filter: FILTER_SANITIZE_STRING);
        $position   = filter_input(type: $inputtype, var_name: 'position', filter: FILTER_SANITIZE_STRING);
        

        require_once 'dbaccess.php';
        require_once 'functions.php';


        if(passwordMatcher($pwd, $confpassword) !== false){
            header("location: ../userlist.php?error=passwordsnotmatching");
            exit();
        }

        updateUserByAdmin($connect, $anrede, $vorname, $nachname, $username, $email, $pwd, $position);
        header("location: ../userlist.php?error=updated");
    }else{
        
        exit();
    }