<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * @author Hector CyC Twitter: @hektorc 
 * Mysnetwork.com
 */
class main extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
	$this->load->library(array ('grocery_CRUD', 'form_validation'));
        $this->load->model('main/main_model');
    }
        function vender()
        {   
            if (isset($_POST['cantidad']) && $_POST['productos']):
            $data['cantidad']  = $_POST['cantidad'];
            $data['productos'] = $_POST['productos'];    
            $data['operacion'] = $this->main_model->totales($data);
            $this->main_model->venta($data);
            $this->load->view('main/vender',$data);
            else:
            $data['categorias'] = $this->main_model->getCats();
            $this->load->view('main/vender', $data);
            endif;
            }
            
        function getProductos()
        {
            $categoria = $this->input->post('categorias'); 
            $data['productos'] = $this->main_model->getProductos($categoria);
            $this->load->view('main/getItems', $data);

        }
        function productos()
        {
             $crud = new grocery_CRUD();
             $crud->set_table('productos');
             $crud->set_relation('cat_id', 'categorias', 'nombre');
             $crud->required_fields('precio','item_name', 'cat_id');
             $output = $crud->render();
             $this->load->view('main/productos', $output);
        }
        
        function ventas()
        {
             $crud = new grocery_CRUD();
             $crud->set_table('ventas');
             $crud->set_relation('producto', 'productos', 'item_name');
             $crud->set_relation('unitario', 'productos', 'precio');
             $crud->display_as('valor', 'Total');
             $crud->unset_add();
             $crud->unset_delete();
             $crud->unset_edit();
             $output = $crud->render();
             $this->load->view('main/ventas', $output);
        }
        function categorias()
        {
            $crud = new grocery_CRUD();
            $crud->set_table('categorias');
            $output = $crud->render();
            $this->load->view('main/ventas', $output);
        }
}