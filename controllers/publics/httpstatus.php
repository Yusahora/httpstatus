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
            return $this->render("httpstatus/login");
        }
        else{
            $user = $this->internal_httpstatus->connect($email, $pwd);
            if($user == false){
                return $this->render("httpstatus/login");
            }
            else{
                session_start();
                $_SESSION['user'] = $user;
                return $this->render("httpstatus/login");
            }
        }
    }
    public function admin (){
        $sites = $this->internal_httpstatus->ShowAll();
        if($_GET['delete'])
        {
            $id = $_GET['delete'];
            $delete = $this->internal_httpstatus->DeleteSite($id);
            return $this->render("httpstatus/admin", [
                "sites" => $sites
            ]);
        }
        elseif($_SESSION['user'] == true){
        return $this->render("httpstatus/admin", [
            "sites" => $sites
        ]);
        }
        
        else{
            return $this->render("httpstatus/error");
        }
    }

    public function add ()
    {
        $url_site = $_POST['url_site'] ?? false;

        if($url_site == false){
            return $this->render('httpstatus/admin/add');
        }
        else{
            $status_url = get_headers($url_site);
            $status = intval(substr($status_url[0], 9, -2));
    
            $site = $this->internal_httpstatus->AddSite($url_site, $status);
    
            if(!$site)
            {
                return $this->render('httpstatus/admin/add');
            }
            else 
            {
                $sites = $this->internal_httpstatus->ShowAll();
                return $this->render("httpstatus/admin", [
                    "sites" => $sites
                ]); 
            }
        } 
        
    }
    
}
