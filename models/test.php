<?php
namespace models;

class test extends \Model
{
    public function get_one_by_url (string $url)
    {   
        return $this->get_one('test', ['url' => $url]);
    }   
    
    public function get_one_by_uid (string $uid)
    {   
        return $this->get_one('test', ['uid' => $uid]);
    }   

    public function get_by_last_click_before (\DateTime $limit_date)
    {
        return $this->get('test', ['<=last_click' => $limit_date->format('Y-m-d H:i:s')]);
    }

    public function create (string $url, string $uid, \DateTime $last_click )
    {   
        return $this->insert('test', [
            'url' => $url,
            'uid' => $uid,
            'last_click' => $last_click->format('Y-m-d H:i:s'),
        ]);
    }

    public function modify (int $id, string $url, string $uid, \DateTime $last_click)
    {   
        return $this->update(
            'test',
            [
                'url' => $url,
                'uid' => $uid,
                'last_click' => $last_click->format('Y-m-d H:i:s'),
            ],
            [
                'id' => $id,
            ]
        );
    }

    public function remove (int $id)
    {
        return $this->delete('test', ['id' => $id]);
    }
}