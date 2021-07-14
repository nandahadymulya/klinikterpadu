<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_obat'));
    }

	private function templates($folder,$file,$data=array())
	{
		$this->load->view('header',$data);
		$this->load->view('menu');
		$this->load->view($folder.'/'.$file);
		$this->load->view('footer');
	}

	public function index()
	{
		$data['title'] = 'Klinik Terpadu &mdash; Halaman Obat';
		$data['pageheader'] = 'Obat';
		$this->templates('obat','index',$data);
	}

	public function ajax()
	{
		$data = array();
		$list = $this->model_obat->get_datatables_data();
		$no = $this->input->post('start');
		foreach ($list as $rows) {

			$tombol = '
				<a class="btn btn-sm bg-primary text-white my-1" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$rows->kd_obat."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm bg-danger text-white my-1" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$rows->kd_obat."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
				';

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->kd_obat;
            $row[] = $rows->nama_obat;
            $row[] = $rows->expired;
            $row[] = $tombol;
 
            $data[] = $row;
        }
        $output = array(
                        "draw" => $this->input->post('draw'),
                        "recordsTotal" => $this->model_obat->count_all_data(),
                        "recordsFiltered" => $this->model_obat->count_filtered_data(),
                        "data" => $data,
                );
        echo json_encode($output);
	}

	public function add()
	{
		$data = array();
        $data['aksi']   = $this->input->post('aksi');
        $this->load->view('obat/add',$data);
	}

	public function save()
	{
		$this->model_obat->validation_form();
		$this->model_obat->init_save();
		echo json_encode(array("status" => TRUE));
	}

	public function edit()
	{
		$kd_obat = $this->input->post('kd_obat');
        $data['detail'] = $this->model_obat->get_data($kd_obat);
        $this->load->view('obat/edit',$data);
	}

	public function update()
	{
		$this->model_obat->validation_form();
        $this->model_obat->init_update();
        echo json_encode(array("status" => TRUE));
	}

	public function delete()
	{
		$this->model_obat->init_delete();
        echo json_encode(array("status" => TRUE));
	}
	
}
