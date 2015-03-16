<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Tutor controller
 */
class Tutor extends Front_Controller
{
    protected $permissionCreate = 'Tutor.Tutor.Create';
    protected $permissionDelete = 'Tutor.Tutor.Delete';
    protected $permissionEdit   = 'Tutor.Tutor.Edit';
    protected $permissionView   = 'Tutor.Tutor.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('tutor/tutor_model');
        $this->lang->load('tutor');
		
        

		Assets::add_module_js('tutor', 'tutor.js');
	}

	/**
	 * Display a list of Tutor data.
	 *
	 * @return void
	 */
	public function index()
	{
        
        
        
        
		$records = $this->tutor_model->find_all();

		Template::set('records', $records);
        

		Template::render();
	}
    
}