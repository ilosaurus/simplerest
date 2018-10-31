<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Article extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data article
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $article = $this->db->get('view_posts')->result();
        } else {
            $this->db->where('id', $id);
            $article = $this->db->get('view_posts')->result();
        }
        $this->response($article, 200);
    }
    // tambah data article
	function index_post() {
        $data = array(
                    'author_id'           => $this->post('author_id'),
                    'title'          => $this->post('title'),
                    'description'          => $this->post('description'),
                    'content'          => $this->post('content')
                );
        $insert = $this->db->insert('posts', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>