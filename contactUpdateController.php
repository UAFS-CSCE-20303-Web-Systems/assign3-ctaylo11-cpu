<?php
    require_once 'model/ContactDAO.php';

    //************************
    //*  Contoller Template  *
    //************************
    showErrors(0);  //1 - Turn on Error Display

    $method=$_SERVER['REQUEST_METHOD'];
    //* Process HTTP GET Request
    if($method=='GET'){
        $id = $_GET['id'];
        $username = $_GET['user'];
        $email = $_GET['email'];
        include 'views/contactUpdate-view.php';
    }
    
    //* Process HTTP POST Request
    if($method=='POST'){
        $contactDAO = new ContactDAO();
        $connection = $contactDAO->getConnection();
        $stmt = $connection->prepare("UPDATE contacts SET username=?, email=? WHERE contactID=?");
        $stmt->bind_param("sss", $_POST['username'], $_POST['email'], $_POST['id']);
        $stmt->execute();
        $stmt->close();
        $connection->close();
        header("Location: contactListController.php");
    }
   

    function showErrors($debug){
        if($debug==1){
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }
    }
?>