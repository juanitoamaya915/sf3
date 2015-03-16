<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Settings controller
 */
class Settings extends Admin_Controller
{
    protected $permissionCreate = 'Tutoria.Settings.Create';
    protected $permissionDelete = 'Tutoria.Settings.Delete';
    protected $permissionEdit   = 'Tutoria.Settings.Edit';
    protected $permissionView   = 'Tutoria.Settings.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
        $this->auth->restrict($this->permissionView);
		$this->load->model('tutoria/tutoria_model');
        $this->lang->load('tutoria');
		
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
		Template::set_block('sub_nav', 'settings/_sub_nav');

		Assets::add_module_js('tutoria', 'tutoria.js');
	}

	/**
	 * Display a list of Tutoria data.
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
					$deleted = $this->tutoria_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
				}
				if ($result) {
					Template::set_message(count($checked) . ' ' . lang('tutoria_delete_success'), 'success');
				} else {
					Template::set_message(lang('tutoria_delete_failure') . $this->tutoria_model->error, 'error');
				}
			}
		}
        
        
        
		$records = $this->tutoria_model->find_all();

		Template::set('records', $records);
        
    Template::set('toolbar_title', lang('tutoria_manage'));

		Template::render();
	}
    
    /**
	 * Create a Tutoria object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict($this->permissionCreate);
        
		if (isset($_POST['save'])) {
			if ($insert_id = $this->save_tutoria()) {
				log_activity($this->auth->user_id(), lang('tutoria_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'tutoria');
				Template::set_message(lang('tutoria_create_success'), 'success');

				redirect(SITE_AREA . '/settings/tutoria');
			}

            // Not validation error
			if ( ! empty($this->tutoria_model->error)) {
				Template::set_message(lang('tutoria_create_failure') . $this->tutoria_model->error, 'error');
            }
		}

		Template::set('toolbar_title', lang('tutoria_action_create'));

		Template::render();
	}
	/**
	 * Allows editing of Tutoria data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		if (empty($id)) {
			Template::set_message(lang('tutoria_invalid_id'), 'error');

			redirect(SITE_AREA . '/settings/tutoria');
		}
        
		if (isset($_POST['save'])) {
			$this->auth->restrict($this->permissionEdit);

			if ($this->save_tutoria('update', $id)) {
				log_activity($this->auth->user_id(), lang('tutoria_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'tutoria');
				Template::set_message(lang('tutoria_edit_success'), 'success');
				redirect(SITE_AREA . '/settings/tutoria');
			}

            // Not validation error
            if ( ! empty($this->tutoria_model->error)) {
                Template::set_message(lang('tutoria_edit_failure') . $this->tutoria_model->error, 'error');
			}
		}
        
		elseif (isset($_POST['delete'])) {
			$this->auth->restrict($this->permissionDelete);

			if ($this->tutoria_model->delete($id)) {
				log_activity($this->auth->user_id(), lang('tutoria_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'tutoria');
				Template::set_message(lang('tutoria_delete_success'), 'success');

				redirect(SITE_AREA . '/settings/tutoria');
			}

            Template::set_message(lang('tutoria_delete_failure') . $this->tutoria_model->error, 'error');
		}
        
        Template::set('tutoria', $this->tutoria_model->find($id));

		Template::set('toolbar_title', lang('tutoria_edit_heading'));
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
	private function save_tutoria($type = 'insert', $id = 0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

        // Validate the data
        $this->form_validation->set_rules($this->tutoria_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

		// Make sure we only pass in the fields we want
		
		$data = $this->tutoria_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
		if ($type == 'insert') {
			$id = $this->tutoria_model->insert($data);

			if (is_numeric($id)) {
				$return = $id;
			}
		} elseif ($type == 'update') {
			$return = $this->tutoria_model->update($id, $data);
		}

		return $return;
	}
}