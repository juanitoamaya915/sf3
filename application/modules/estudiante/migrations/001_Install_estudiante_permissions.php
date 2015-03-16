<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_estudiante_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Estudiante.Content.View',
			'description' => 'View Estudiante Content',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Content.Create',
			'description' => 'Create Estudiante Content',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Content.Edit',
			'description' => 'Edit Estudiante Content',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Content.Delete',
			'description' => 'Delete Estudiante Content',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Reports.View',
			'description' => 'View Estudiante Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Reports.Create',
			'description' => 'Create Estudiante Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Reports.Edit',
			'description' => 'Edit Estudiante Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Reports.Delete',
			'description' => 'Delete Estudiante Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Settings.View',
			'description' => 'View Estudiante Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Settings.Create',
			'description' => 'Create Estudiante Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Settings.Edit',
			'description' => 'Edit Estudiante Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Settings.Delete',
			'description' => 'Delete Estudiante Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Developer.View',
			'description' => 'View Estudiante Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Developer.Create',
			'description' => 'Create Estudiante Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Developer.Edit',
			'description' => 'Edit Estudiante Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Estudiante.Developer.Delete',
			'description' => 'Delete Estudiante Developer',
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