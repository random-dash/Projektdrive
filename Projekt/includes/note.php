<?php
session_start();

require_once "dbaccess.php";
$inputtype = INPUT_POST;
$note       = filter_input(type: $inputtype, var_name: 'note', filter: FILTER_SANITIZE_STRING);
$ticketID = $_POST["ticketID"];
$userID = $_SESSION["id"];

$sql = "INSERT INTO notes (note, ticketID, userID) VALUES (?, ?, ?);";
$stmt = mysqli_stmt_init($connect);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "sss", $note, $ticketID, $userID);
mysqli_stmt_execute($stmt);
if($_SESSION["position"] == 'service'){
    header("location: ../serviceTickets.php?error=noteuploaded");
}else{
    header("location: ../tickets.php?error=noteuploaded");
}
exit();


