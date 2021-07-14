<?php
class Model_obat extends CI_Model
{	
    var $column_order_data = array(null,'kd_obat','nama_obat','expired', null);
    var $column_search_data = array('kd_obat','nama_obat','expired');
    var $order_data = array('kd_obat' => 'desc'); 

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
 
        if($this->input->post('nama_obat') == '')
        {
            $data['inputerror'][] = 'nama_obat';
            $data['error_string'][] = 'Nama Obat Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('expired') == '')
        {
            $data['inputerror'][] = 'expired';
            $data['error_string'][] = 'Expired Obat Wajib diisi.';
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
        $this->mydb1->SELECT('kd_obat,
                                nama_obat,
                                expired');
        $this->mydb1->from('tb_obat');
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
        $this->mydb1->SELECT('kd_obat,
                                nama_obat,
                                expired');
        $this->mydb1->from('tb_obat');
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
        $query = $this->mydb1->query("SELECT MAX(kd_obat) as kdobat from tb_obat");
        $hasil = $query->row();
        return $hasil->kdobat;

    }

    public function init_save()
    {
        $kd_obat        = $this->generate_code();
        $urutan         = (int) substr($kd_obat, 3, 3);
        $urutan++;
        $huruf          = "OB";
        $kdObat         = $huruf . sprintf("%03s", $urutan);

        $nama_obat      = $this->input->post('nama_obat');
        $expired    = $this->input->post('expired');

        $this->mydb1->trans_start();
        $this->mydb1->set('kd_obat',$kdObat);
        $this->mydb1->set('nama_obat',$nama_obat);
        $this->mydb1->set('expired',$expired);
        $this->mydb1->insert('tb_obat');

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

    public function get_data($kd_obat)
    {
        $this->mydb1->SELECT('kd_obat,
                                nama_obat,
                                expired');
        $this->mydb1->FROM('tb_obat');
        $this->mydb1->WHERE('kd_obat',$kd_obat);
        $query = $this->mydb1->get();
        return $query->row();
    }

    public function init_update()
    {
        $kd_obat    = $this->input->post('kd_obat');
        $nama_obat  = $this->input->post('nama_obat');
        $expired    = $this->input->post('expired$expired');

        $this->mydb1->trans_start();
        $this->mydb1->set('nama_obat',$nama_obat);
        $this->mydb1->set('expired',$expired);
        $this->mydb1->WHERE('kd_obat',$kd_obat);
        $this->mydb1->update('tb_obat');

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
        $kd_obat  = $this->input->post('kd_obat');

        $this->mydb1->trans_start();
        $this->mydb1->WHERE('kd_obat',$kd_obat);
        $this->mydb1->delete('tb_obat');

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