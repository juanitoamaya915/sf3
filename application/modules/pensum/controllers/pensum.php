<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Pensum controller
 */
class Pensum extends Front_Controller
{
    protected $permissionCreate = 'Pensum.Pensum.Create';
    protected $permissionDelete = 'Pensum.Pensum.Delete';
    protected $permissionEdit   = 'Pensum.Pensum.Edit';
    protected $permissionView   = 'Pensum.Pensum.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('pensum/pensum_model');
        $this->lang->load('pensum');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
        

		Assets::add_module_js('pensum', 'pensum.js');
	}

	/**
	 * Display a list of Pensum data.
	 *
	 * @return void
	 */
	public function index()
	{
        
        
        
        
		$records = $this->pensum_model->find_all();

		Template::set('records', $records);
        

		Template::render();
	}
    
}