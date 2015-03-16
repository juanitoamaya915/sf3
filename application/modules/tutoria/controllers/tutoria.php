<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Tutoria controller
 */
class Tutoria extends Front_Controller
{
    protected $permissionCreate = 'Tutoria.Tutoria.Create';
    protected $permissionDelete = 'Tutoria.Tutoria.Delete';
    protected $permissionEdit   = 'Tutoria.Tutoria.Edit';
    protected $permissionView   = 'Tutoria.Tutoria.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('tutoria/tutoria_model');
        $this->lang->load('tutoria');
		
        

		Assets::add_module_js('tutoria', 'tutoria.js');
	}

	/**
	 * Display a list of Tutoria data.
	 *
	 * @return void
	 */
	public function index()
	{
        
        
        
        
		$records = $this->tutoria_model->find_all();

		Template::set('records', $records);
        

		Template::render();
	}
    
}