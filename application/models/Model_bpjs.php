<?php
class Model_bpjs extends CI_Model
{	
    var $column_order_data = array(null,'id_pasien','nama','alamat','tempat_lahir','tanggal_lahir','nohp','jenis_rawat','status_bpjs', null);
    var $column_search_data = array('id_pasien','nama','alamat','tempat_lahir','tanggal_lahir','nohp','jenis_rawat','status_bpjs');
    var $order_data = array('id_pasien' => 'desc'); 

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
            $data['error_string'][] = 'Nama Pasien Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('alamat') == '')
        {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat Pasien Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('tempat_lahir') == '')
        {
            $data['inputerror'][] = 'tempat_lahir';
            $data['error_string'][] = 'Tempat Lahir Pasien Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('tanggal_lahir') == '')
        {
            $data['inputerror'][] = 'tanggal_lahir';
            $data['error_string'][] = 'Tanggal Lahir Pasien Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('nohp') == '')
        {
            $data['inputerror'][] = 'nohp';
            $data['error_string'][] = 'Nohp Pasien Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('jenis_rawat') == '')
        {
            $data['inputerror'][] = 'jenis_rawat';
            $data['error_string'][] = 'Jenis Rawat Pasien Wajib diisi.';
            $data['status'] = FALSE;
        }
        if($this->input->post('status_bpjs') == '')
        {
            $data['inputerror'][] = 'status_bpjs';
            $data['error_string'][] = 'Status BPJS Pasien Wajib diisi.';
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
        $this->mydb1->SELECT('id_pasien,
                                nama,
                                alamat,
                                tempat_lahir,
                                tanggal_lahir,
                                nohp,
                                jenis_rawat,
                                status_bpjs');
        $this->mydb1->from('tb_pasien');
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
        $this->mydb1->SELECT('id_pasien,
                                nama,
                                alamat,
                                tempat_lahir,
                                tanggal_lahir,
                                nohp,
                                jenis_rawat,
                                status_bpjs');
        $this->mydb1->from('tb_pasien');
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
        $query = $this->mydb1->query("SELECT MAX(id_pasien) as idpasien from tb_pasien");
        $hasil = $query->row();
        return $hasil->idpasien;

    }

    public function init_save()
    {
        $id_pasien      = $this->generate_code();
        $urutan         = (int) substr($id_pasien, 3, 3);
        $urutan++;
        $huruf          = "PS";
        $idPasien       = $huruf . sprintf("%03s", $urutan);

        $nama           = $this->input->post('nama');
        $alamat         = $this->input->post('alamat');
        $tempat_lahir   = $this->input->post('tempat_lahir');
        $tanggal_lahir  = $this->input->post('tanggal_lahir');
        $nohp           = $this->input->post('nohp');
        $jenis_rawat    = $this->input->post('jenis_rawat');
        $status_bpjs    = $this->input->post('status_bpjs');

        $this->mydb1->trans_start();
        $this->mydb1->set('id_pasien',$idPasien);
        $this->mydb1->set('nama',$nama);
        $this->mydb1->set('alamat',$alamat);
        $this->mydb1->set('tempat_lahir',$tempat_lahir);
        $this->mydb1->set('tanggal_lahir',$tanggal_lahir);
        $this->mydb1->set('nohp',$nohp);
        $this->mydb1->set('jenis_rawat',$jenis_rawat);
        $this->mydb1->set('status_bpjs',$status_bpjs);
        $this->mydb1->insert('tb_pasien');

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

    public function get_data($id_pasien)
    {
        $this->mydb1->SELECT('id_pasien,
                                nama,
                                alamat,
                                tempat_lahir,
                                tanggal_lahir,
                                nohp,
                                jenis_rawat,
                                status_bpjs');
        $this->mydb1->FROM('tb_pasien');
        $this->mydb1->WHERE('id_pasien',$id_pasien);
        $query = $this->mydb1->get();
        return $query->row();
    }

    public function init_update()
    {
        $id_pasien      = $this->input->post('id_pasien');
        $nama           = $this->input->post('nama');
        $alamat         = $this->input->post('alamat');
        $tempat_lahir   = $this->input->post('tempat_lahir');
        $tanggal_lahir  = $this->input->post('tanggal_lahir');
        $nohp           = $this->input->post('nohp');
        $jenis_rawat    = $this->input->post('jenis_rawat');
        $status_bpjs    = $this->input->post('status_bpjs');

        $this->mydb1->trans_start();
        $this->mydb1->set('nama',$nama);
        $this->mydb1->set('alamat',$alamat);
        $this->mydb1->set('tempat_lahir',$tempat_lahir);
        $this->mydb1->set('tanggal_lahir',$tanggal_lahir);
        $this->mydb1->set('nohp',$nohp);
        $this->mydb1->set('jenis_rawat',$jenis_rawat);
        $this->mydb1->set('status_bpjs',$status_bpjs);
        $this->mydb1->WHERE('id_pasien',$id_pasien);
        $this->mydb1->update('tb_pasien');

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
        $id_pasien  = $this->input->post('id_pasien');

        $this->mydb1->trans_start();
        $this->mydb1->WHERE('id_pasien',$id_pasien);
        $this->mydb1->delete('tb_pasien');

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