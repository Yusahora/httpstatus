<?php
namespace controllers\internals;

use \models\Httpstatus as ModelHttpstatus;

class Httpstatus extends \InternalController
{
    public function __construct (\PDO $pdo)
    {
        $this->model_httpstatus = new ModelHttpstatus($pdo);
    }

    public function connect(){
        $log = $this->model_httpstatus->get_admin($email, $pwd);
        if($log['pwd'] === $pwd && $log['email'] === $email){
            return $log;
        }
        else{
            return false;
        }
    }
}