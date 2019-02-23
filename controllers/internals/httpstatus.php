<?php
namespace controllers\internals;

use \models\httpstatus as ModelHttpstatus;

class Httpstatus extends \InternalController
{
    public function __construct (\PDO $pdo)
    {
        $this->model_httpstatus = new ModelHttpstatus($pdo);
    }

    public function connect($email, $pwd)
    {
        $login = $this->model_httpstatus->get_info($email, $pwd);
        if($login['mdp'] === $pwd){
            return $login;
        }
        else
        {
            return false;
        }
    }
}