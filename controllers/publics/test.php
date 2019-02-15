<?php
namespace controllers\publics;

//use \controllers\internals\test as Internaltest;

class test extends \Controller
{
    public function home ()
    {
        return self::render('test/home', ['success' => false]);
    }
}