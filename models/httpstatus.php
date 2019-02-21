<?php
namespace models;

class httpstatus extends \Model
{
    public function connexion(string $email, string $pwd){
        return $this->get_one('admin', [
            'email' => $email
         ]);
    }
}