<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_carreras_universitarias_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Carreras_universitarias.Content.View',
			'description' => 'View Carreras_universitarias Content',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Content.Create',
			'description' => 'Create Carreras_universitarias Content',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Content.Edit',
			'description' => 'Edit Carreras_universitarias Content',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Content.Delete',
			'description' => 'Delete Carreras_universitarias Content',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Reports.View',
			'description' => 'View Carreras_universitarias Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Reports.Create',
			'description' => 'Create Carreras_universitarias Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Reports.Edit',
			'description' => 'Edit Carreras_universitarias Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Reports.Delete',
			'description' => 'Delete Carreras_universitarias Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Settings.View',
			'description' => 'View Carreras_universitarias Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Settings.Create',
			'description' => 'Create Carreras_universitarias Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Settings.Edit',
			'description' => 'Edit Carreras_universitarias Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Settings.Delete',
			'description' => 'Delete Carreras_universitarias Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Developer.View',
			'description' => 'View Carreras_universitarias Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Developer.Create',
			'description' => 'Create Carreras_universitarias Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Developer.Edit',
			'description' => 'Edit Carreras_universitarias Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Carreras_universitarias.Developer.Delete',
			'description' => 'Delete Carreras_universitarias Developer',
			'status' => 'active',
		),
    );

    /**
     * @var string The name of the permission key in the role_permissions table
     */
    private $permissionKey = 'permission_id';

    /**
     * @var string The name of the permission name field in the permissions table
     */
    private $permissionNameField = 'name';

	/**
	 * @var string The name of the role/permissions ref table
	 */
	private $rolePermissionsTable = 'role_permissions';

    /**
     * @var numeric The role id to which the permissions will be applied
     */
    private $roleId = '1';

    /**
     * @var string The name of the role key in the role_permissions table
     */
    private $roleKey = 'role_id';

	/**
	 * @var string The name of the permissions table
	 */
	private $tableName = 'permissions';

	//--------------------------------------------------------------------

	/**
	 * Install this version
	 *
	 * @return void
	 */
	public function up()
	{
		$rolePermissionsData = array();
		foreach ($this->permissionValues as $permissionValue) {
			$this->db->insert($this->tableName, $permissionValue);

			$rolePermissionsData[] = array(
                $this->roleKey       => $this->roleId,
                $this->permissionKey => $this->db->insert_id(),
			);
		}

		$this->db->insert_batch($this->rolePermissionsTable, $rolePermissionsData);
	}

	/**
	 * Uninstall this version
	 *
	 * @return void
	 */
	public function down()
	{
        $permissionNames = array();
		foreach ($this->permissionValues as $permissionValue) {
            $permissionNames[] = $permissionValue[$this->permissionNameField];
        }

        $query = $this->db->select($this->permissionKey)
                          ->where_in($this->permissionNameField, $permissionNames)
                          ->get($this->tableName);

        if ( ! $query->num_rows()) {
            return;
        }

        $permissionIds = array();
        foreach ($query->result() as $row) {
            $permissionIds[] = $row->{$this->permissionKey};
        }

        $this->db->where_in($this->permissionKey, $permissionIds)
                 ->delete($this->rolePermissionsTable);

        $this->db->where_in($this->permissionNameField, $permissionNames)
                 ->delete($this->tableName);
	}
}