<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_supplier'));
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
		$data['title'] = 'Literasi Store &mdash; Master Supplier';
		$data['pageheader'] = 'Master Supplier';
		$this->templates('supplier','index',$data);
	}

	public function ajax()
	{
		$data = array();
		$list = $this->model_supplier->get_datatables_data();
		$no = $this->input->post('start');
		foreach ($list as $rows) {

			$tombol = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$rows->id_supplier."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$rows->id_supplier."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->id_supplier;
            $row[] = $rows->nama;
            $row[] = $rows->alamat;
            $row[] = $rows->telp;
            $row[] = $tombol;
 
            $data[] = $row;
        }
        $output = array(
                        "draw" => $this->input->post('draw'),
                        "recordsTotal" => $this->model_supplier->count_all_data(),
                        "recordsFiltered" => $this->model_supplier->count_filtered_data(),
                        "data" => $data,
                );
        echo json_encode($output);
	}

	public function add()
	{
		$data = array();
        $data['aksi']   = $this->input->post('aksi');
        $this->load->view('supplier/add',$data);
	}

	public function save()
	{
		$this->model_supplier->validation_form();
		$this->model_supplier->init_save();
		echo json_encode(array("status" => TRUE));
	}

	public function edit()
	{
		$id_supplier = $this->input->post('id_supplier');
        $data['detail'] = $this->model_supplier->get_data($id_supplier);
        $this->load->view('supplier/edit',$data);
	}

	public function update()
	{
		$this->model_supplier->validation_form();
        $this->model_supplier->init_update();
        echo json_encode(array("status" => TRUE));
	}

	public function delete()
	{
		$this->model_supplier->init_delete();
        echo json_encode(array("status" => TRUE));
	}
	
}
