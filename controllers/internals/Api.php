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
}
