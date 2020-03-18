<?php
class Product_model extends CI_Model{

	function getdata($tbl){
		$hasil=$this->db->get($tbl);
		return $hasil->result();
	}

	function insert($tbl,$data){

		$result=$this->db->insert($tbl,$data);
		return $result;
	}

	function update_product(){
		$product_code=$this->input->post('product_code');
		$product_name=$this->input->post('product_name');
		$product_price=$this->input->post('price');

		$this->db->set('product_name', $product_name);
		$this->db->set('product_price', $product_price);
		$this->db->where('product_code', $product_code);
		$result=$this->db->update('product');
		return $result;
	}
	 public function updatesingleconddata($tbname,$data,$cond){
       foreach ($cond as $key => $value) {
            $this->db->where($key,$value);
        }
        $upd = $this->db->update($tbname,$data);
        return $upd;
    }

	function delete_data($tbname,$cond){
		foreach ($cond as $key => $value) {
            $this->db->where($key,$value);
        }
		$result=$this->db->delete($tbname);
		return $result;
	}
	
}