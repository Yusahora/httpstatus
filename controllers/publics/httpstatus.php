<?php
namespace controllers\publics;

use \controllers\internals\httpstatus as InternalHttpstatus;

class httpstatus extends \Controller
{
    public function __construct (\PDO $pdo)
    {
        parent::__construct($pdo);
        $this->internal_httpstatus = new InternalHttpstatus($pdo);
    }
    public function home()
    {   
        return $this->render("httpstatus/home");
    } 
    public function login ()
    {
        $email = $_POST['email'] ?? false;
        $pwd = $_POST['password'] ?? false;
        
        if($email == false || $pwd == false){
            return $this->render('httpstatus/login', [
                "success" => true
            ]);
        }
        else {
            $conn = $this->internal_httpstatus->connect($email, $pwd);

            if($conn == false){
                return $this->render('httpstatus/login', [
                    "success" => false
                ]);
            }
            else{
                session_start();
                $_SESSION['user'] = $conn;
                return $this->render('httpstatus/login', [
                    "success" => true
                ]);
            }


        }
        
        
    }
    public function admin (){
        if($_SESSION['user']){
        session_destroy();
        return $this->render("httpstatus/admin");
        }
        else{
            return $this->render("httpstatus/error");
        }
    }
    
}
