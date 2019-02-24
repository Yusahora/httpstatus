<?php
namespace models;

class httpstatus extends \Model
{
   public function get_user(string $email, string $pwd){
      return $this->get_one('admin', [
         'email' => $email
      ]);
   }
   public function AllSites(){
      return $this->get('list_site');
   }
   public function NewSite(string $url_site, int $status_site)
   {
      return $this->insert('list_site', [
         'url_site' => $url_site,
         'status_site' => $status_site
      ]);
   }

   public function deleteSite(int $id)
   {
      return $this->delete('list_site', [
         'id' => $id
      ]);
   }
}