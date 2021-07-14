<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aset extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_aset'));
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
		$data['title'] = 'Klinik Terpadu &mdash; Halaman Aset';
		$data['pageheader'] = 'Aset';
		$this->templates('aset','index',$data);
	}

	public function ajax()
	{
		$data = array();
		$list = $this->model_aset->get_datatables_data();
		$no = $this->input->post('start');
		foreach ($list as $rows) {

			$tombol = '
				<a class="btn btn-sm bg-primary text-white my-1" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$rows->kd_aset."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm bg-danger text-white my-1" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$rows->kd_aset."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
				';

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->kd_aset;
            $row[] = $rows->nama_aset;
            $row[] = $rows->tanggal_beli;
            $row[] = $tombol;
 
            $data[] = $row;
        }
        $output = array(
                        "draw" => $this->input->post('draw'),
                        "recordsTotal" => $this->model_aset->count_all_data(),
                        "recordsFiltered" => $this->model_aset->count_filtered_data(),
                        "data" => $data,
                );
        echo json_encode($output);
	}

	public function add()
	{
		$data = array();
        $data['aksi'] = $this->input->post('aksi');
        $this->load->view('aset/add',$data);
	}

	public function save()
	{
		$this->model_aset->validation_form();
		$this->model_aset->init_save();
		echo json_encode(array("status" => TRUE));
	}

	public function edit()
	{
		$kd_aset = $this->input->post('kd_aset');
        $data['detail'] = $this->model_aset->get_data($kd_aset);
        $this->load->view('aset/edit',$data);
	}

	public function update()
	{
		$this->model_aset->validation_form();
        $this->model_aset->init_update();
        echo json_encode(array("status" => TRUE));
	}

	public function delete()
	{
		$this->model_aset->init_delete();
        echo json_encode(array("status" => TRUE));
	}
	
}
