<?php
namespace models;

class Api extends \Model
{
 public function get_all(){
     return $this->get('list_site');
 }
 public function create_site(string $url_site)
 {
    return $this->insert('list_site', [
       'url_site' => $url_site,
    ]);
 }
}