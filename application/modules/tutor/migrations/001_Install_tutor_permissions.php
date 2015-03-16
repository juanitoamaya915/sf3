<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_tutor_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Tutor.Content.View',
			'description' => 'View Tutor Content',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Content.Create',
			'description' => 'Create Tutor Content',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Content.Edit',
			'description' => 'Edit Tutor Content',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Content.Delete',
			'description' => 'Delete Tutor Content',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Reports.View',
			'description' => 'View Tutor Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Reports.Create',
			'description' => 'Create Tutor Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Reports.Edit',
			'description' => 'Edit Tutor Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Reports.Delete',
			'description' => 'Delete Tutor Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Settings.View',
			'description' => 'View Tutor Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Settings.Create',
			'description' => 'Create Tutor Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Settings.Edit',
			'description' => 'Edit Tutor Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Settings.Delete',
			'description' => 'Delete Tutor Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Developer.View',
			'description' => 'View Tutor Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Developer.Create',
			'description' => 'Create Tutor Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Developer.Edit',
			'description' => 'Edit Tutor Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Tutor.Developer.Delete',
			'description' => 'Delete Tutor Developer',
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