<?php
namespace controllers\publics;

use \controllers\internals\Httpstatus as InternalHttpstatus;

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
        return $this->render("httpstatus/login");
    }
}
