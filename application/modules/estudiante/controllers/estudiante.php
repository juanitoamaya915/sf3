<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Estudiante controller
 */
class Estudiante extends Front_Controller
{
    protected $permissionCreate = 'Estudiante.Estudiante.Create';
    protected $permissionDelete = 'Estudiante.Estudiante.Delete';
    protected $permissionEdit   = 'Estudiante.Estudiante.Edit';
    protected $permissionView   = 'Estudiante.Estudiante.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('estudiante/estudiante_model');
        $this->lang->load('estudiante');
		
        

		Assets::add_module_js('estudiante', 'estudiante.js');
	}

	/**
	 * Display a list of Estudiante data.
	 *
	 * @return void
	 */
	public function index()
	{
        
        
        
        
		$records = $this->estudiante_model->find_all();

		Template::set('records', $records);
        

		Template::render();
	}
    
}