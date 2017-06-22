<?php

class Home extends CI_Controller
{
    function __construct()
    {
        parent:: __construct();
        $this->load->model('Home_model');
    }

    public function index(){
        $this->load->view('home_view', array('error' => ''));
    }

    public function upload(){
        $files = $_FILES['uploadimage'];
        $dir = 'uploads/';
        $number_of_files = count($_FILES['uploadimage']['tmp_name']);

        $this->load->library('upload');
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'jpg|jpeg|png';

        for ($i = 0; $i < $number_of_files; $i++){
            $_FILES['uploadimage']['name'] = $files['name'][$i];
            $_FILES['uploadimage']['type'] = $files['type'][$i];
            $_FILES['uploadimage']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['uploadimage']['error'] = $files['error'][$i];
            $_FILES['uploadimage']['size'] = $files['size'][$i];

            $this->upload->initialize($config);
            if ($this->upload->do_upload('uploadimage')){
                $photoData = array(
                    'name' => $this->upload->data('file_name')
                );
                $this->Home_model->addPhoto($photoData);
            }
        }
        redirect(base_url());
    }
}


//            $config['upload_path'] = 'uploads/';
//            $config['allowed_types'] = 'gif|jpg|png';
//            $this->load->library('upload', $config);
//            if ($this->upload->do_upload('photo')) {
//
//                $photodata = array(
//                    'ads_id'=> $add_id,
//                    'ads_photo' => $this->upload->data('file_name')
//
//                );
//
//                $this->ads_model->addPhotoqwe($photodata);
