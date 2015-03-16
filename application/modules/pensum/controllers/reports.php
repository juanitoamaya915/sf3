<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Reports controller
 */
class Reports extends Admin_Controller
{
    protected $permissionCreate = 'Pensum.Reports.Create';
    protected $permissionDelete = 'Pensum.Reports.Delete';
    protected $permissionEdit   = 'Pensum.Reports.Edit';
    protected $permissionView   = 'Pensum.Reports.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
        $this->auth->restrict($this->permissionView);
		$this->load->model('pensum/pensum_model');
        $this->lang->load('pensum');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
		Template::set_block('sub_nav', 'reports/_sub_nav');

		Assets::add_module_js('pensum', 'pensum.js');
	}

	/**
	 * Display a list of Pensum data.
	 *
	 * @return void
	 */
	public function index()
	{
        // Deleting anything?
		if (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);
			$checked = $this->input->post('checked');
			if (is_array($checked) && count($checked)) {

                // If any of the deletions fail, set the result to false, so
                // failure message is set if any of the attempts fail, not just
                // the last attempt

				$result = true;
				foreach ($checked as $pid) {
					$deleted = $this->pensum_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
				}
				if ($result) {
					Template::set_message(count($checked) . ' ' . lang('pensum_delete_success'), 'success');
				} else {
					Template::set_message(lang('pensum_delete_failure') . $this->pensum_model->error, 'error');
				}
			}
		}
        
        
        
		$records = $this->pensum_model->find_all();

		Template::set('records', $records);
        
    Template::set('toolbar_title', lang('pensum_manage'));

		Template::render();
	}
    
    /**
	 * Create a Pensum object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict($this->permissionCreate);
        
		if (isset($_POST['save'])) {
			if ($insert_id = $this->save_pensum()) {
				log_activity($this->auth->user_id(), lang('pensum_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'pensum');
				Template::set_message(lang('pensum_create_success'), 'success');

				redirect(SITE_AREA . '/reports/pensum');
			}

            // Not validation error
			if ( ! empty($this->pensum_model->error)) {
				Template::set_message(lang('pensum_create_failure') . $this->pensum_model->error, 'error');
            }
		}

		Template::set('toolbar_title', lang('pensum_action_create'));

		Template::render();
	}
	/**
	 * Allows editing of Pensum data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		if (empty($id)) {
			Template::set_message(lang('pensum_invalid_id'), 'error');

			redirect(SITE_AREA . '/reports/pensum');
		}
        
		if (isset($_POST['save'])) {
			$this->auth->restrict($this->permissionEdit);

			if ($this->save_pensum('update', $id)) {
				log_activity($this->auth->user_id(), lang('pensum_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'pensum');
				Template::set_message(lang('pensum_edit_success'), 'success');
				redirect(SITE_AREA . '/reports/pensum');
			}

            // Not validation error
            if ( ! empty($this->pensum_model->error)) {
                Template::set_message(lang('pensum_edit_failure') . $this->pensum_model->error, 'error');
			}
		}
        
		elseif (isset($_POST['delete'])) {
			$this->auth->restrict($this->permissionDelete);

			if ($this->pensum_model->delete($id)) {
				log_activity($this->auth->user_id(), lang('pensum_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'pensum');
				Template::set_message(lang('pensum_delete_success'), 'success');

				redirect(SITE_AREA . '/reports/pensum');
			}

            Template::set_message(lang('pensum_delete_failure') . $this->pensum_model->error, 'error');
		}
        
        Template::set('pensum', $this->pensum_model->find($id));

		Template::set('toolbar_title', lang('pensum_edit_heading'));
		Template::render();
	}

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/**
	 * Save the data.
	 *
	 * @param string $type Either 'insert' or 'update'.
	 * @param int	 $id	The ID of the record to update, ignored on inserts.
	 *
	 * @return bool|int An int ID for successful inserts, true for successful
     * updates, else false.
	 */
	private function save_pensum($type = 'insert', $id = 0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

        // Validate the data
        $this->form_validation->set_rules($this->pensum_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

		// Make sure we only pass in the fields we want
		
		$data = $this->pensum_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        
		$data['fecha']	= $this->input->post('fecha') ? $this->input->post('fecha') : '0000-00-00';

        $return = false;
		if ($type == 'insert') {
			$id = $this->pensum_model->insert($data);

			if (is_numeric($id)) {
				$return = $id;
			}
		} elseif ($type == 'update') {
			$return = $this->pensum_model->update($id, $data);
		}

		return $return;
	}
}