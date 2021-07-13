<?php
class Model_barang extends CI_Model
{	
    var $column_order_data = array(null,'kode_barang','nama','satuan', null);
    var $column_search_data = array('kode_barang','nama','satuan');
    var $order_data = array('kode_barang' => 'desc'); 

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
 
        if($this->input->post('nama_barang') == '')
        {
            $data['inputerror'][] = 'nama_barang';
            $data['error_string'][] = 'Nama Barang Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('satuan_barang') == '')
        {
            $data['inputerror'][] = 'satuan_barang';
            $data['error_string'][] = 'Satuan Barang Wajib diisi.';
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
        $this->mydb1->SELECT('kode_barang,
                                nama,
                                satuan');
        $this->mydb1->from('tb_barang');
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
        $this->mydb1->SELECT('kode_barang,
                                nama,
                                satuan');
        $this->mydb1->from('tb_barang');
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
        $query = $this->mydb1->query("SELECT MAX(kode_barang) as kodebarang from tb_barang");
        $hasil = $query->row();
        return $hasil->kodebarang;

    }

    public function init_save()
    {
        $kode_barang    = $this->generate_code();
        $urutan         = (int) substr($kode_barang, 3, 3);
        $urutan++;
        $huruf          = "BRG";
        $kodeBarang     = $huruf . sprintf("%03s", $urutan);

        $nama           = $this->input->post('nama_barang');
        $satuan         = $this->input->post('satuan_barang');

        $this->mydb1->trans_start();
        $this->mydb1->set('kode_barang',$kodeBarang);
        $this->mydb1->set('nama',$nama);
        $this->mydb1->set('satuan',$satuan);
        $this->mydb1->insert('tb_barang');

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

    public function get_data($kode_barang)
    {
        $this->mydb1->SELECT('kode_barang,
                                nama,
                                satuan');
        $this->mydb1->FROM('tb_barang');
        $this->mydb1->WHERE('kode_barang',$kode_barang);
        $query = $this->mydb1->get();
        return $query->row();
    }

    public function init_update()
    {
        $kode_barang    = $this->input->post('kode_barang');
        $nama           = $this->input->post('nama_barang');
        $satuan         = $this->input->post('satuan_barang');

        $this->mydb1->trans_start();
        $this->mydb1->set('nama',$nama);
        $this->mydb1->set('satuan',$satuan);
        $this->mydb1->WHERE('kode_barang',$kode_barang);
        $this->mydb1->update('tb_barang');

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
        $kode_barang         = $this->input->post('kode_barang');

        $this->mydb1->trans_start();
        $this->mydb1->WHERE('kode_barang',$kode_barang);
        $this->mydb1->delete('tb_barang');

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