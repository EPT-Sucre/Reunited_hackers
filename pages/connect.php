<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$email = $_POST['email'];
$password = $_POST['password'];

include 'temp.php'; 
$connection = new mysqli($serverip, $username, $data_password);
mysqli_select_db($connection,$database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT id, password FROM users WHERE email = ?"; 

$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($identifiant, $pass);
$stmt->fetch();
$stmt->close();

if(md5($pass) == $password){
    session_start();
    $_SESSION["Id"] = $identifiant;

    // header("Location: ../index.php");
    // exit();
}
else{
    // header("Location: ./login.php");
    echo ""
}

?>