<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Carreras_universitarias controller
 */
class Carreras_universitarias extends Front_Controller
{
    protected $permissionCreate = 'Carreras_universitarias.Carreras_universitarias.Create';
    protected $permissionDelete = 'Carreras_universitarias.Carreras_universitarias.Delete';
    protected $permissionEdit   = 'Carreras_universitarias.Carreras_universitarias.Edit';
    protected $permissionView   = 'Carreras_universitarias.Carreras_universitarias.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('carreras_universitarias/carreras_universitarias_model');
        $this->lang->load('carreras_universitarias');
		
        

		Assets::add_module_js('carreras_universitarias', 'carreras_universitarias.js');
	}

	/**
	 * Display a list of Carreras Universitarias data.
	 *
	 * @return void
	 */
	public function index()
	{
        
        
        
        
		$records = $this->carreras_universitarias_model->find_all();

		Template::set('records', $records);
        

		Template::render();
	}
    
}