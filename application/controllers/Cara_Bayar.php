<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cara_Bayar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Cara_Bayar');
    }

    public function index()
    {

        $data['title'] = 'Master Data - Cara Bayar';
        backView("cara_bayar/index", $data);
    }
    public function list_cara_bayar()
    {
        $list = $this->M_Cara_Bayar->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $value->cara_bayar;
            $row[] = $value->status;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data,
            "recordsTotal" => $this->M_Cara_Bayar->count_all(),
            "recordsFiltered" => $this->M_Cara_Bayar->count_filtered(),
        );
        echo json_encode($output);
    }

    public function get()
    {
        $id = $this->input->post('id');
        $data = $this->M_Cara_Bayar->get($id);
        echo json_encode($data);
    }
    public function getNew()
    {
        $id = $this->input->post('id');
        $data = $this->M_Cara_Bayar->getNew($id);
        echo json_encode($data);
    }

    public function create()
    {
        $data = [
            'id' => $this->input->post('id'),
            'cara_bayar' => $this->input->post('cara_bayar'),
            'created_at' => date('Y-m-d H:i:s')
        ];
	$check = $this->M_Cara_Bayar->getFirstByName( $this->input->post('cara_bayar'));
        if($check!=null) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(422)
                ->set_output(json_encode("Cara Pembayar Telah Ada"));
          
        }
        $res = $this->M_Cara_Bayar->create($data);
        echo json_encode($res);
    }
    public function remove()
    {
        $id = $this->input->post('id');
        $res = $this->M_Cara_Bayar->delete($id);
        echo json_encode($res);
    }
    public function update()
    {
        $id = $this->input->post('id');
        $data = [
            'cara_bayar' => $this->input->post('cara_bayar'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $res = $this->M_Cara_Bayar->update($id, $data);
        echo json_encode($res);
    }
}
