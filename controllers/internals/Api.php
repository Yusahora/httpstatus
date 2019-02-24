<?php
namespace controllers\internals;

use \models\Api as ModelApi;
use \models\httpstatus as ModelHttpstatus;

class Api extends \InternalController
{
    public function __construct (\PDO $pdo)
    {
        $this->model_api = new ModelApi($pdo);
        $this->model_httpstatus = new ModelHttpstatus($pdo);
    }

    public function get_list(){
        $liste = $this->model_api->get_all();
        if($liste == true){
            return $liste;
        }
        else{
            return false;
        }
    }
    public function addSite(string $url_site)
    {
        $site = $this->model_api->create_site($url_site);

        if($site == true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function deleteSite(int $id)
    {
        $delete = $this->model_httpstatus->deleteSite($id);

        if($delete == true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
