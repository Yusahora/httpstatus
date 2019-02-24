<?php
namespace controllers\internals;

use \models\httpstatus as ModelHttpstatus;

class Httpstatus extends \InternalController
{
    public function __construct (\PDO $pdo)
    {
        $this->model_httpstatus = new ModelHttpstatus($pdo);
    }

    public function connect (string $email, string $pwd){
        $user = $this->model_httpstatus->get_user($email, $pwd);
        if($user['email'] === $email || $user['password'] === $pwd){
            return $user;
        }
        else{
            return false;
        }
    }
    public function ShowAll(){
    $sites = $this->model_httpstatus->AllSites();

       if($sites == true)
       {
           return $sites;
       }
       else
       {
           return false;
       }
    }

    public function AddSite(string $url_site, int $status){

        $add = $this->model_httpstatus->NewSite($url_site, $status);

        if($add == true){
            return $add;
        }
        else{
            return false;
        }
    }
    public function DeleteSite(int $id)
    {
        $delete = $this->model_httpstatus->deleteSite($id);

        if($delete)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}