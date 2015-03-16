<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_cliente_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Cliente.Content.View',
			'description' => 'View Cliente Content',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Content.Create',
			'description' => 'Create Cliente Content',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Content.Edit',
			'description' => 'Edit Cliente Content',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Content.Delete',
			'description' => 'Delete Cliente Content',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Reports.View',
			'description' => 'View Cliente Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Reports.Create',
			'description' => 'Create Cliente Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Reports.Edit',
			'description' => 'Edit Cliente Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Reports.Delete',
			'description' => 'Delete Cliente Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Settings.View',
			'description' => 'View Cliente Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Settings.Create',
			'description' => 'Create Cliente Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Settings.Edit',
			'description' => 'Edit Cliente Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Settings.Delete',
			'description' => 'Delete Cliente Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Developer.View',
			'description' => 'View Cliente Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Developer.Create',
			'description' => 'Create Cliente Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Developer.Edit',
			'description' => 'Edit Cliente Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Cliente.Developer.Delete',
			'description' => 'Delete Cliente Developer',
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