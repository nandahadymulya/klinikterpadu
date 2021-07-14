<?php
class Model_aset extends CI_Model
{	
    var $column_order_data = array(null,'kd_aset','nama_aset','tanggal_beli', null);
    var $column_search_data = array('kd_aset','nama_aset','tanggal_beli');
    var $order_data = array('kd_aset' => 'desc'); 

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
 
        if($this->input->post('nama_aset') == '')
        {
            $data['inputerror'][] = 'nama_aset';
            $data['error_string'][] = 'Nama Aset Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('tanggal_beli') == '')
        {
            $data['inputerror'][] = 'tanggal_beli';
            $data['error_string'][] = 'Tanggal Lahir Aset Wajib diisi.';
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
        $this->mydb1->SELECT('kd_aset,
                                nama_aset,
                                tanggal_beli');
        $this->mydb1->from('tb_aset');
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
        $this->mydb1->SELECT('kd_aset,
                                nama_aset,
                                tanggal_beli');
        $this->mydb1->from('tb_aset');
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
        $query = $this->mydb1->query("SELECT MAX(kd_aset) as kdaset from tb_aset");
        $hasil = $query->row();
        return $hasil->kdaset;

    }

    public function init_save()
    {
        $kd_aset        = $this->generate_code();
        $urutan         = (int) substr($kd_aset, 3, 3);
        $urutan++;
        $huruf          = "AS";
        $kdAset         = $huruf . sprintf("%03s", $urutan);

        $nama_aset      = $this->input->post('nama_aset');
        $tanggal_beli   = $this->input->post('tanggal_beli');

        $this->mydb1->trans_start();
        $this->mydb1->set('kd_aset',$kdAset);
        $this->mydb1->set('nama_aset',$nama_aset);
        $this->mydb1->set('tanggal_beli',$tanggal_beli);
        $this->mydb1->insert('tb_aset');

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

    public function get_data($kd_aset)
    {
        $this->mydb1->SELECT('kd_aset,
                                nama_aset,
                                tanggal_beli');
        $this->mydb1->FROM('tb_aset');
        $this->mydb1->WHERE('kd_aset',$kd_aset);
        $query = $this->mydb1->get();
        return $query->row();
    }

    public function init_update()
    {
        $kd_aset        = $this->input->post('kd_aset');
        $nama_aset      = $this->input->post('nama_aset');
        $tanggal_beli   = $this->input->post('tanggal_beli');

        $this->mydb1->trans_start();
        $this->mydb1->set('nama_aset',$nama_aset);
        $this->mydb1->set('tanggal_beli',$tanggal_beli);
        $this->mydb1->WHERE('kd_aset',$kd_aset);
        $this->mydb1->update('tb_aset');

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
        $kd_aset  = $this->input->post('kd_aset');

        $this->mydb1->trans_start();
        $this->mydb1->WHERE('kd_aset',$kd_aset);
        $this->mydb1->delete('tb_aset');

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