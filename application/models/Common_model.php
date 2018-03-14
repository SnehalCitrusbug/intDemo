<?php

class Common_model extends CI_Model
{
    public function get_multiple_data($tableName,$fieldName,$fieldOrder)
    {
        $this->db->select('*');
		$this->db->from($tableName);
		$this->db->order_by($fieldName,$fieldOrder);
		$query=$this->db->get();
		return $query->result();
    }
	public function get_multiple_data_via_limit($tableName,$fieldName,$fieldOrder,$limit, $start)
    {
        $this->db->select('*');
		$this->db->from($tableName);
		$this->db->order_by($fieldName,$fieldOrder);
		$this->db->limit($limit, $start);
		$query=$this->db->get();
		return $query->result();
    }
	public function get_multiple_data_of_product()
    {
		$this->db->select('p.*,c.catName as catId,u.fName,u.lName');
		$this->db->from('product p'); 
		$this->db->join('category c', 'c.catId=p.catId', 'left');
		$this->db->join('user u', 'u.userId=p.userId', 'left');
		$this->db->order_by('p.productId','DESC');         
		$query = $this->db->get(); 
		return $query->result();
		
    }
	public function get_multiple_data_of_product_via_limit($limit, $start)
    {
		$this->db->select('p.*,c.catName as catId,u.fName,u.lName');
		$this->db->from('product p'); 
		$this->db->join('category c', 'c.catId=p.catId', 'left');
		$this->db->join('user u', 'u.userId=p.userId', 'left');
		$this->db->limit($limit, $start);
		$this->db->order_by('p.productId','DESC');         
		$query = $this->db->get(); 
		return $query->result();
		
    }
	public function get_single_record($tableName,$fieldName,$fieldValue)
    {
        $this->db->select('*');
		$this->db->from($tableName);
		$this->db->where($fieldName, $fieldValue);
		$query=$this->db->get();
		return $query->row();
    }
	public function update_record($tableName,$fieldName,$fieldValue,$data)
	{
		$this->db->where($fieldName, $fieldValue);
		$this->db->update($tableName, $data);
	}
	public function delete_multiple_data($tableName,$fieldName,$data)
	{
		$this->db->where_in($fieldName, $data);
        $this->db->delete($tableName);
	}
	public function insert_record($tableName,$data)
	{
		$this->db->insert($tableName, $data);
		return $this->db->insert_id();
	}
}


?>