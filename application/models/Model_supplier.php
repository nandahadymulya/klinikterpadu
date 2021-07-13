<?php
class Model_supplier extends CI_Model
{	
    var $column_order_data = array(null,'id_supplier','nama','alamat','telp', null);
    var $column_search_data = array('id_supplier','nama','alamat','telp');
    var $order_data = array('id_supplier' => 'desc'); 

    public function __construct()
    {
        parent::__construct();
        $this->mydb1 = $this->load->database('default',TRUE);
    }

    public function validation_form()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama Supplier Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('alamat') == '')
        {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat Supplier Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('telp') == '')
        {
            $data['inputerror'][] = 'telp';
            $data['error_string'][] = 'Telp Supplier Wajib diisi.';
            $data['status'] = FALSE;
        }
  
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function get_datatables_data()
    {
        $this->_get_datatables_query_data();
        if($_POST['length'] != -1)
            $this->mydb1->limit($_POST['length'], $_POST['start']);
        $query = $this->mydb1->get();
        return $query->result();
    }

    public function _get_datatables_query_data()
    {
        $this->mydb1->SELECT('id_supplier,
                                nama,
                                alamat,
                                telp');
        $this->mydb1->from('tb_supplier');
        $i = 0;
        foreach ($this->column_search_data as $item) 
        {
            if($_POST['search']['value']) 
            {
                if($i===0) 
                {
                    $this->mydb1->group_start(); 
                    $this->mydb1->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->mydb1->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_data) - 1 == $i)
                    $this->mydb1->group_end(); 
            }
            $i++;
        }
        if(isset($_POST['order']))
        {
            $this->mydb1->order_by($this->column_order_data[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_data))
        {
            $order = $this->order_data;
            $this->mydb1->order_by(key($order), $order[key($order)]);
        }
    }

    public function count_all_data()
    {
        $this->mydb1->SELECT('id_supplier,
                                nama,
                                alamat,
                                telp');
        $this->mydb1->from('tb_supplier');
        return $this->mydb1->count_all_results();
    }

    public function count_filtered_data()
    {
        $this->_get_datatables_query_data();
        $query = $this->mydb1->get();
        return $query->num_rows();
    }

    public function generate_code()
    {
        $query = $this->mydb1->query("SELECT MAX(id_supplier) as idsupplier from tb_supplier");
        $hasil = $query->row();
        return $hasil->idsupplier;
    }

    public function init_save()
    {
        $id_supplier    = $this->generate_code();
        $urutan         = (int) substr($id_supplier, 3, 3);
        $urutan++;
        $huruf          = "SPL";
        $idSupplier     = $huruf . sprintf("%03s", $urutan);

        $nama           = $this->input->post('nama');
        $alamat         = $this->input->post('alamat');
        $telp           = $this->input->post('telp');

        $this->mydb1->trans_start();
        $this->mydb1->set('id_supplier',$idSupplier);
        $this->mydb1->set('nama',$nama);
        $this->mydb1->set('alamat',$alamat);
        $this->mydb1->set('telp',$telp);
        $this->mydb1->insert('tb_supplier');

        $this->mydb1->trans_complete();
        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            $this->error();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            return TRUE;
        }
    }

    public function get_data($id_supplier)
    {
        $this->mydb1->SELECT('id_supplier,
                                nama,
                                alamat,
                                telp');
        $this->mydb1->FROM('tb_supplier');
        $this->mydb1->WHERE('id_supplier',$id_supplier);
        $query = $this->mydb1->get();
        return $query->row();
    }

    public function init_update()
    {
        $id_supplier    = $this->input->post('id_supplier');
        $nama           = $this->input->post('nama');
        $alamat         = $this->input->post('alamat');
        $telp           = $this->input->post('telp');

        $this->mydb1->trans_start();
        $this->mydb1->set('nama',$nama);
        $this->mydb1->set('alamat',$alamat);
        $this->mydb1->set('telp',$telp);
        $this->mydb1->WHERE('id_supplier',$id_supplier);
        $this->mydb1->update('tb_supplier');

        $this->mydb1->trans_complete();
        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            $this->error();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            return TRUE;
        }
    }

    public function init_delete()
    {
        $id_supplier         = $this->input->post('id_supplier');

        $this->mydb1->trans_start();
        $this->mydb1->WHERE('id_supplier',$id_supplier);
        $this->mydb1->delete('tb_supplier');

        $this->mydb1->trans_complete();
        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            $this->error();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            return TRUE;
        }
    }


}