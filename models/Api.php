<?php
namespace models;

class Api extends \Model
{
 public function get_all(){
     return $this->get('list_site');
 }
}