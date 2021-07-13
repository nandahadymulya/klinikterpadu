<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_pasien'));
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
		$data['title'] = 'KlinikTerpadu &mdash; Halaman Pasien';
		$data['pageheader'] = 'Pasien';
		$this->templates('pasien','index',$data);
	}

	public function ajax()
	{
		$data = array();
		$list = $this->model_pasien->get_datatables_data();
		$no = $this->input->post('start');
		foreach ($list as $rows) {

			$tombol = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$rows->id_pasien."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$rows->id_pasien."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->id_pasien;
            $row[] = $rows->nama;
            $row[] = $rows->alamat;
            $row[] = $rows->penyakit;
            $row[] = $rows->jenis_rawat;
            $row[] = $rows->status_bpjs;
            $row[] = $tombol;
 
            $data[] = $row;
        }
        $output = array(
                        "draw" => $this->input->post('draw'),
                        "recordsTotal" => $this->model_pasien->count_all_data(),
                        "recordsFiltered" => $this->model_pasien->count_filtered_data(),
                        "data" => $data,
                );
        echo json_encode($output);
	}

	public function add()
	{
		$data = array();
        $data['aksi']   = $this->input->post('aksi');
        $this->load->view('pasien/add',$data);
	}

	public function save()
	{
		$this->model_pasien->validation_form();
		$this->model_pasien->init_save();
		echo json_encode(array("status" => TRUE));
	}

	public function edit()
	{
		$id_pasien = $this->input->post('id_pasien');
        $data['detail'] = $this->model_pasien->get_data($id_pasien);
        $this->load->view('pasien/edit',$data);
	}

	public function update()
	{
		$this->model_pasien->validation_form();
        $this->model_pasien->init_update();
        echo json_encode(array("status" => TRUE));
	}

	public function delete()
	{
		$this->model_pasien->init_delete();
        echo json_encode(array("status" => TRUE));
	}
	
}
