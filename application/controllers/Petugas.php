<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_petugas'));
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
		$data['title'] = 'Klinik Terpadu &mdash; Halaman Petugas';
		$data['pageheader'] = 'Petugas';
		$this->templates('petugas','index',$data);
	}

	public function ajax()
	{
		$data = array();
		$list = $this->model_petugas->get_datatables_data();
		$no = $this->input->post('start');
		foreach ($list as $rows) {

			$tombol = '
				<a class="btn btn-sm bg-primary text-white my-1" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$rows->id_petugas."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm bg-danger text-white my-1" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$rows->id_petugas."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
				';

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->id_petugas;
            $row[] = $rows->nama_petugas;
            $row[] = $rows->tanggal_lahir;
            $row[] = $rows->alamat_petugas;
            $row[] = $rows->nohp;

            $row[] = $tombol;
 
            $data[] = $row;
        }
        $output = array(
                        "draw" => $this->input->post('draw'),
                        "recordsTotal" => $this->model_petugas->count_all_data(),
                        "recordsFiltered" => $this->model_petugas->count_filtered_data(),
                        "data" => $data,
                );
        echo json_encode($output);
	}

	public function add()
	{
		$data = array();
        $data['aksi']   = $this->input->post('aksi');
        $this->load->view('petugas/add',$data);
	}

	public function save()
	{
		$this->model_petugas->validation_form();
		$this->model_petugas->init_save();
		echo json_encode(array("status" => TRUE));
	}

	public function edit()
	{
		$id_petugas = $this->input->post('id_petugas');
        $data['detail'] = $this->model_petugas->get_data($id_petugas);
        $this->load->view('petugas/edit',$data);
	}

	public function update()
	{
		$this->model_petugas->validation_form();
        $this->model_petugas->init_update();
        echo json_encode(array("status" => TRUE));
	}

	public function delete()
	{
		$this->model_petugas->init_delete();
        echo json_encode(array("status" => TRUE));
	}
	
}
