<?php 
    
    include 'dbaccess.php';
    $id = $_POST["id"];

    if(isset($_POST["suClose"])){
        $sql = "UPDATE tickets SET status = 'erfolgreich geschlossen' WHERE ticketID = ?;";
        $stmt = mysqli_stmt_init($connect);

        if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../serviceTickets.php?error=statementfailed");
        exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        header("location: ../serviceTickets.php?error=NONE");
        exit();
    }else if(isset($_POST["faClose"])){
        $sql = "UPDATE tickets SET status = 'erfolglos geschlossen' WHERE ticketID = ?;";
        $stmt = mysqli_stmt_init($connect);

        if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../serviceTickets.php?error=statementfailed");
        exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        header("location: ../serviceTickets.php?error=NONE");
        exit();
    }else if(isset($_POST["open"])){
        $sql = "UPDATE tickets SET status = 'offen' WHERE ticketID = ?;";
        $stmt = mysqli_stmt_init($connect);

        if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../serviceTickets.php?error=statementfailed");
        exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        header("location: ../serviceTickets.php?error=NONE");
        exit();
    }
