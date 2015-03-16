<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_tutoria_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Tutoria.Content.View',
			'description' => 'View Tutoria Content',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Content.Create',
			'description' => 'Create Tutoria Content',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Content.Edit',
			'description' => 'Edit Tutoria Content',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Content.Delete',
			'description' => 'Delete Tutoria Content',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Reports.View',
			'description' => 'View Tutoria Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Reports.Create',
			'description' => 'Create Tutoria Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Reports.Edit',
			'description' => 'Edit Tutoria Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Reports.Delete',
			'description' => 'Delete Tutoria Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Settings.View',
			'description' => 'View Tutoria Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Settings.Create',
			'description' => 'Create Tutoria Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Settings.Edit',
			'description' => 'Edit Tutoria Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Settings.Delete',
			'description' => 'Delete Tutoria Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Developer.View',
			'description' => 'View Tutoria Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Developer.Create',
			'description' => 'Create Tutoria Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Developer.Edit',
			'description' => 'Edit Tutoria Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Tutoria.Developer.Delete',
			'description' => 'Delete Tutoria Developer',
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