<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    
    function apiauth($apiKey){
        try{
            $resposta = FALSE;
            $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
            $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            
            $statement = $db->prepare("SELECT * FROM devs WHERE apiKey = :apiKey");
            $statement->bindValue(':apiKey',$apiKey);
            $statement->execute();
            if(count($statement->fetchAll()) == 1){
                $resposta = TRUE;
            }
            unset($db);
            return $resposta;
        }catch(PDOException $exception){
            echo $exception;
            unset($db);
            die();
        }
    }
?>