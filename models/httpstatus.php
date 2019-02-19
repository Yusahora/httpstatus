<?php
namespace models;

class Httpstatus extends \Model
{
    public function connexion(string $email, string $pwd){
        return $this->get_one('admin', [
            'email' => $email
         ]);
    }
}