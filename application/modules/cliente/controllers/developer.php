<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Developer controller
 */
class Developer extends Admin_Controller
{
    protected $permissionCreate = 'Cliente.Developer.Create';
    protected $permissionDelete = 'Cliente.Developer.Delete';
    protected $permissionEdit   = 'Cliente.Developer.Edit';
    protected $permissionView   = 'Cliente.Developer.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
        $this->auth->restrict($this->permissionView);
		$this->load->model('cliente/cliente_model');
        $this->lang->load('cliente');
		
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
		Template::set_block('sub_nav', 'developer/_sub_nav');

		Assets::add_module_js('cliente', 'cliente.js');
	}

	/**
	 * Display a list of cliente data.
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
					$deleted = $this->cliente_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
				}
				if ($result) {
					Template::set_message(count($checked) . ' ' . lang('cliente_delete_success'), 'success');
				} else {
					Template::set_message(lang('cliente_delete_failure') . $this->cliente_model->error, 'error');
				}
			}
		}
        
        
        
		$records = $this->cliente_model->find_all();

		Template::set('records', $records);
        
    Template::set('toolbar_title', lang('cliente_manage'));

		Template::render();
	}
    
    /**
	 * Create a cliente object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict($this->permissionCreate);
        
		if (isset($_POST['save'])) {
			if ($insert_id = $this->save_cliente()) {
				log_activity($this->auth->user_id(), lang('cliente_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'cliente');
				Template::set_message(lang('cliente_create_success'), 'success');

				redirect(SITE_AREA . '/developer/cliente');
			}

            // Not validation error
			if ( ! empty($this->cliente_model->error)) {
				Template::set_message(lang('cliente_create_failure') . $this->cliente_model->error, 'error');
            }
		}

		Template::set('toolbar_title', lang('cliente_action_create'));

		Template::render();
	}
	/**
	 * Allows editing of cliente data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		if (empty($id)) {
			Template::set_message(lang('cliente_invalid_id'), 'error');

			redirect(SITE_AREA . '/developer/cliente');
		}
        
		if (isset($_POST['save'])) {
			$this->auth->restrict($this->permissionEdit);

			if ($this->save_cliente('update', $id)) {
				log_activity($this->auth->user_id(), lang('cliente_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'cliente');
				Template::set_message(lang('cliente_edit_success'), 'success');
				redirect(SITE_AREA . '/developer/cliente');
			}

            // Not validation error
            if ( ! empty($this->cliente_model->error)) {
                Template::set_message(lang('cliente_edit_failure') . $this->cliente_model->error, 'error');
			}
		}
        
		elseif (isset($_POST['delete'])) {
			$this->auth->restrict($this->permissionDelete);

			if ($this->cliente_model->delete($id)) {
				log_activity($this->auth->user_id(), lang('cliente_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'cliente');
				Template::set_message(lang('cliente_delete_success'), 'success');

				redirect(SITE_AREA . '/developer/cliente');
			}

            Template::set_message(lang('cliente_delete_failure') . $this->cliente_model->error, 'error');
		}
        
        Template::set('cliente', $this->cliente_model->find($id));

		Template::set('toolbar_title', lang('cliente_edit_heading'));
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
	private function save_cliente($type = 'insert', $id = 0)
	{
		if ($type == 'update') {
			$_POST['id_cliente'] = $id;
		}

        // Validate the data
        $this->form_validation->set_rules($this->cliente_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

		// Make sure we only pass in the fields we want
		
		$data = $this->cliente_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
		if ($type == 'insert') {
			$id = $this->cliente_model->insert($data);

			if (is_numeric($id)) {
				$return = $id;
			}
		} elseif ($type == 'update') {
			$return = $this->cliente_model->update($id, $data);
		}

		return $return;
	}
}