<?php
class Model_petugas extends CI_Model
{	
    var $column_order_data = array(null,'id_petugas','nama_petugas','tanggal_lahir','alamat_petugas','nohp', null);
    var $column_search_data = array('id_petugas','nama_petugas','tanggal_lahir','alamat_petugas','nohp');
    var $order_data = array('id_petugas' => 'desc'); 

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
 
        if($this->input->post('nama_petugas') == '')
        {
            $data['inputerror'][] = 'nama_petugas';
            $data['error_string'][] = 'Nama Petugas Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('tanggal_lahir') == '')
        {
            $data['inputerror'][] = 'tanggal_lahir';
            $data['error_string'][] = 'Tanggal Lahir Petugas Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('alamat_petugas') == '')
        {
            $data['inputerror'][] = 'alamat_petugas';
            $data['error_string'][] = 'alamat_petugas Petugas Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('nohp') == '')
        {
            $data['inputerror'][] = 'nohp';
            $data['error_string'][] = 'Nohp Petugas Wajib diisi.';
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
        $this->mydb1->SELECT('id_petugas,
                                nama_petugas,
                                tanggal_lahir,
                                alamat_petugas,
                                nohp');
        $this->mydb1->from('tb_petugas');
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
        $this->mydb1->SELECT('id_petugas,
                                nama_petugas,
                                tanggal_lahir,
                                alamat_petugas,
                                nohp');
        $this->mydb1->from('tb_petugas');
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
        $query = $this->mydb1->query("SELECT MAX(id_petugas) as idpetugas from tb_petugas");
        $hasil = $query->row();
        return $hasil->idpetugas;

    }

    public function init_save()
    {
        $id_petugas     = $this->generate_code();
        $urutan         = (int) substr($id_petugas, 3, 3);
        $urutan++;
        $huruf          = "PS";
        $idPetugas      = $huruf . sprintf("%03s", $urutan);

        $nama_petugas   = $this->input->post('nama_petugas');
        $tanggal_lahir  = $this->input->post('tanggal_lahir');
        $alamat_petugas = $this->input->post('alamat_petugas');
        $nohp           = $this->input->post('nohp');

        $this->mydb1->trans_start();
        $this->mydb1->set('id_petugas',$idPetugas);
        $this->mydb1->set('nama_petugas',$nama_petugas);
        $this->mydb1->set('tanggal_lahir',$tanggal_lahir);
        $this->mydb1->set('alamat_petugas',$alamat_petugas);
        $this->mydb1->set('nohp',$nohp);
        $this->mydb1->insert('tb_petugas');

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

    public function get_data($id_petugas)
    {
        $this->mydb1->SELECT('id_petugas,
                                nama_petugas,
                                tanggal_lahir,
                                alamat_petugas,
                                nohp');
        $this->mydb1->FROM('tb_petugas');
        $this->mydb1->WHERE('id_petugas',$id_petugas);
        $query = $this->mydb1->get();
        return $query->row();
    }

    public function init_update()
    {
        $id_petugas     = $this->input->post('id_petugas');
        $nama_petugas   = $this->input->post('nama_petugas');
        $tanggal_lahir  = $this->input->post('tanggal_lahir');
        $alamat_petugas = $this->input->post('alamat_petugas');
        $nohp           = $this->input->post('nohp');

        $this->mydb1->trans_start();
        $this->mydb1->set('nama_petugas',$nama_petugas);
        $this->mydb1->set('tanggal_lahir',$tanggal_lahir);
        $this->mydb1->set('alamat_petugas',$alamat_petugas);
        $this->mydb1->set('nohp',$nohp);
        $this->mydb1->WHERE('id_petugas',$id_petugas);
        $this->mydb1->update('tb_petugas');

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
        $id_petugas  = $this->input->post('id_petugas');

        $this->mydb1->trans_start();
        $this->mydb1->WHERE('id_petugas',$id_petugas);
        $this->mydb1->delete('tb_petugas');

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