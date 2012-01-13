<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * @author Hector CyC Twitter: @hektorc 
 * Mysnetwork.com
 */
class Main_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function venta($data){
        
             $consulta = $this->db->having('id', $data['productos']);
             $consulta = $this->db->get('productos');
             foreach ($consulta->result() as $row)
             {
             $insert = array (
                'producto' => $data['productos'],
                 'cantidad'=> $data['cantidad'],
                 'unitario' => $data['productos'],
                 'valor'    => $row->precio*$data['cantidad'],);
             $this->db->insert('ventas', $insert);
    }}
    function getProductos($id)
    {       
                $data=array();
		$q2 = $this->db->select('*');
                $q2 = $this->db->order_by('item_name','asc');
		$q2 = $this->db->where('cat_id',$id);
		$q2 = $this->db->get('productos');
		foreach ($q2->result_array() as $row2){
			$data[] = $row2;
		}
		return($data);
    }
    function getCats()
    {
         $data=array();
		$q2 = $this->db->select('*');
		$q2 = $this->db->get('categorias');
		foreach ($q2->result_array() as $row2){
			$data[] = $row2;
		}
		return($data);
    }
    function totales($data)
    {
        $this->db->select('*');
        $this->db->having('id',$data['productos']);
        $query = $this->db->get('productos');
        return $query->result_array();
    }
}