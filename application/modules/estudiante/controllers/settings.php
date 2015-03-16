<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Settings controller
 */
class Settings extends Admin_Controller
{
    protected $permissionCreate = 'Estudiante.Settings.Create';
    protected $permissionDelete = 'Estudiante.Settings.Delete';
    protected $permissionEdit   = 'Estudiante.Settings.Edit';
    protected $permissionView   = 'Estudiante.Settings.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
        $this->auth->restrict($this->permissionView);
		$this->load->model('estudiante/estudiante_model');
        $this->lang->load('estudiante');
		
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
		Template::set_block('sub_nav', 'settings/_sub_nav');

		Assets::add_module_js('estudiante', 'estudiante.js');
	}

	/**
	 * Display a list of Estudiante data.
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
					$deleted = $this->estudiante_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
				}
				if ($result) {
					Template::set_message(count($checked) . ' ' . lang('estudiante_delete_success'), 'success');
				} else {
					Template::set_message(lang('estudiante_delete_failure') . $this->estudiante_model->error, 'error');
				}
			}
		}
        
        
        
		$records = $this->estudiante_model->find_all();

		Template::set('records', $records);
        
    Template::set('toolbar_title', lang('estudiante_manage'));

		Template::render();
	}
    
    /**
	 * Create a Estudiante object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict($this->permissionCreate);
        
		if (isset($_POST['save'])) {
			if ($insert_id = $this->save_estudiante()) {
				log_activity($this->auth->user_id(), lang('estudiante_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'estudiante');
				Template::set_message(lang('estudiante_create_success'), 'success');

				redirect(SITE_AREA . '/settings/estudiante');
			}

            // Not validation error
			if ( ! empty($this->estudiante_model->error)) {
				Template::set_message(lang('estudiante_create_failure') . $this->estudiante_model->error, 'error');
            }
		}

		Template::set('toolbar_title', lang('estudiante_action_create'));

		Template::render();
	}
	/**
	 * Allows editing of Estudiante data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		if (empty($id)) {
			Template::set_message(lang('estudiante_invalid_id'), 'error');

			redirect(SITE_AREA . '/settings/estudiante');
		}
        
		if (isset($_POST['save'])) {
			$this->auth->restrict($this->permissionEdit);

			if ($this->save_estudiante('update', $id)) {
				log_activity($this->auth->user_id(), lang('estudiante_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'estudiante');
				Template::set_message(lang('estudiante_edit_success'), 'success');
				redirect(SITE_AREA . '/settings/estudiante');
			}

            // Not validation error
            if ( ! empty($this->estudiante_model->error)) {
                Template::set_message(lang('estudiante_edit_failure') . $this->estudiante_model->error, 'error');
			}
		}
        
		elseif (isset($_POST['delete'])) {
			$this->auth->restrict($this->permissionDelete);

			if ($this->estudiante_model->delete($id)) {
				log_activity($this->auth->user_id(), lang('estudiante_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'estudiante');
				Template::set_message(lang('estudiante_delete_success'), 'success');

				redirect(SITE_AREA . '/settings/estudiante');
			}

            Template::set_message(lang('estudiante_delete_failure') . $this->estudiante_model->error, 'error');
		}
        
        Template::set('estudiante', $this->estudiante_model->find($id));

		Template::set('toolbar_title', lang('estudiante_edit_heading'));
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
	private function save_estudiante($type = 'insert', $id = 0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

        // Validate the data
        $this->form_validation->set_rules($this->estudiante_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

		// Make sure we only pass in the fields we want
		
		$data = $this->estudiante_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
		if ($type == 'insert') {
			$id = $this->estudiante_model->insert($data);

			if (is_numeric($id)) {
				$return = $id;
			}
		} elseif ($type == 'update') {
			$return = $this->estudiante_model->update($id, $data);
		}

		return $return;
	}
}