<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_bpjs'));
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
		$data['title'] = 'Klinik Terpadu &mdash; Halaman BPJS';
		$data['pageheader'] = 'BPJS';
		$this->templates('bpjs','index',$data);
	}

	public function ajax()
	{
		$data = array();
		$list = $this->model_bpjs->get_datatables_data();
		$no = $this->input->post('start');
		foreach ($list as $rows) {

			$tombol = '
				<a class="btn btn-sm bg-primary text-white my-1" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$rows->no_kartu."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm bg-danger text-white my-1" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$rows->no_kartu."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
				';

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->no_kartu;
            $row[] = $rows->nama;
            $row[] = $rows->alamat;
            $row[] = $rows->tempat_lahir;
            $row[] = $rows->tanggal_lahir;
            $row[] = $rows->nohp;
            $row[] = $rows->jenis_rawat;
            $row[] = $rows->status_bpjs;
            $row[] = $tombol;
 
            $data[] = $row;
        }
        $output = array(
                        "draw" => $this->input->post('draw'),
                        "recordsTotal" => $this->model_bpjs->count_all_data(),
                        "recordsFiltered" => $this->model_bpjs->count_filtered_data(),
                        "data" => $data,
                );
        echo json_encode($output);
	}

	public function add()
	{
		$data = array();
        $data['aksi']   = $this->input->post('aksi');
        $this->load->view('bpjs/add',$data);
	}

	public function save()
	{
		$this->model_bpjs->validation_form();
		$this->model_bpjs->init_save();
		echo json_encode(array("status" => TRUE));
	}

	public function edit()
	{
		$id_pasien = $this->input->post('id_pasien');
        $data['detail'] = $this->model_bpjs->get_data($id_pasien);
        $this->load->view('pasien/edit',$data);
	}

	public function update()
	{
		$this->model_bpjs->validation_form();
        $this->model_bpjs->init_update();
        echo json_encode(array("status" => TRUE));
	}

	public function delete()
	{
		$this->model_bpjs->init_delete();
        echo json_encode(array("status" => TRUE));
	}
	
}
