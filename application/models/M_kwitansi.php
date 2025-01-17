<?php
class M_kwitansi extends CI_Model
{
    public function tampil_kwitansi()
    {
        return $this->db->get('tbl_kwitansi');
    }

    public function tambah_kwitansi()
    {

        //    KWI/0001/12/2022
        $kode = "";
        $today = date('Y-m-d');
        $bulan = date("m");
        $tahun = date("Y");
        $select = $this->db->query("SELECT * FROM tbl_kwitansi WHERE DATE(date_created) ='$today'")->result_array();
        $count = count($select);
        $count++;
        $count = sprintf("%04d", $count);
        $kode = "KWI-OPT/$count/$bulan/$tahun";

        $data = array(

            "kode_kwitansi" => $kode,
            "nominal" => $this->input->post('nominal'),
            "harga_jual" => $this->input->post('harga'),
            "karyawan" => $this->input->post('karyawan'),
            "date_created" => date('Y-m-d H:i:s'),

        );
        $data_resume = [
            'method_types' => 'Cash',
            'amount' => $this->input->post('harga'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tbl_resume', $data_resume);
        $this->db->insert('tbl_kwitansi', $data);
    }
    public function get_kwitansi($id)
    {
        return $this->db->get_where('tbl_kwitansi', array("id_kwitansi" => $id));
    }

    public function hapus_kwitansi($id)
    {
        $this->db->delete('kwitansi', ['id_kwitansi' => $id]);
    }
}
