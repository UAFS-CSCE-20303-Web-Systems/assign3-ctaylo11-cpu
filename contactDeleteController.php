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
        $contactDAO = new ContactDAO();
        $connection = $contactDAO->getConnection();
        $stmt = $connection->prepare("DELETE FROM contacts WHERE contactID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close();
        $connection->close();
        header("Location: contactListController.php");
    }
    
    //* Process HTTP POST Request
    if($method=='POST'){

    }
   

    function showErrors($debug){
        if($debug==1){
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }
    }
?>