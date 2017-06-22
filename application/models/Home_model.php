<?php

class Home_model extends CI_Model
{
    public function addPhoto($photoData){
        $this->db->insert('photo', $photoData);
    }
}
