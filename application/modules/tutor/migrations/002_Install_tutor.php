<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_tutor extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'tutor';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id_tutor' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'nombre_tutor' => array(
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'null'       => false,
        ),
        'apellido_tutor' => array(
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'null'       => false,
        ),
        'correo_electronico' => array(
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'null'       => false,
        ),
        'direccion_tutor' => array(
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'null'       => true,
        ),
        'celular_tutor' => array(
            'type'       => 'VARCHAR',
            'constraint' => 10,
            'null'       => false,
        ),
	);

	/**
	 * Install this version
	 *
	 * @return void
	 */
	public function up()
	{
		$this->dbforge->add_field($this->fields);
		$this->dbforge->add_key('id_tutor', true);
		$this->dbforge->create_table($this->table_name);
	}

	/**
	 * Uninstall this version
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dbforge->drop_table($this->table_name);
	}
}