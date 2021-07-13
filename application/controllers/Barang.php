<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_barang'));
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
		$data['title'] = 'Literasi Store &mdash; Master Barang';
		$data['pageheader'] = 'Master Barang';
		$this->templates('barang','index',$data);
	}

	public function ajax()
	{
		$data = array();
		$list = $this->model_barang->get_datatables_data();
		$no = $this->input->post('start');
		foreach ($list as $rows) {

			$tombol = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$rows->kode_barang."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$rows->kode_barang."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->kode_barang;
            $row[] = $rows->nama;
            $row[] = $rows->satuan;
            $row[] = $tombol;
 
            $data[] = $row;
        }
        $output = array(
                        "draw" => $this->input->post('draw'),
                        "recordsTotal" => $this->model_barang->count_all_data(),
                        "recordsFiltered" => $this->model_barang->count_filtered_data(),
                        "data" => $data,
                );
        echo json_encode($output);
	}

	public function add()
	{
		$data = array();
        $data['aksi']   = $this->input->post('aksi');
        $this->load->view('barang/add',$data);
	}

	public function save()
	{
		$this->model_barang->validation_form();
		$this->model_barang->init_save();
		echo json_encode(array("status" => TRUE));
	}

	public function edit()
	{
		$kode_barang = $this->input->post('kode_barang');
        $data['detail'] = $this->model_barang->get_data($kode_barang);
        $this->load->view('barang/edit',$data);
	}

	public function update()
	{
		$this->model_barang->validation_form();
        $this->model_barang->init_update();
        echo json_encode(array("status" => TRUE));
	}

	public function delete()
	{
		$this->model_barang->init_delete();
        echo json_encode(array("status" => TRUE));
	}
	
}
