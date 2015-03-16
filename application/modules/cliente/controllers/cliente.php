<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Cliente controller
 */
class Cliente extends Front_Controller
{
    protected $permissionCreate = 'Cliente.Cliente.Create';
    protected $permissionDelete = 'Cliente.Cliente.Delete';
    protected $permissionEdit   = 'Cliente.Cliente.Edit';
    protected $permissionView   = 'Cliente.Cliente.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('cliente/cliente_model');
        $this->lang->load('cliente');
		
        

		Assets::add_module_js('cliente', 'cliente.js');
	}

	/**
	 * Display a list of cliente data.
	 *
	 * @return void
	 */
	public function index()
	{
        
        
        
        
		$records = $this->cliente_model->find_all();

		Template::set('records', $records);
        

		Template::render();
	}
    
}