<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_cliente extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'cliente';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id_cliente' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'nombre' => array(
            'type'       => 'VARCHAR',
            'constraint' => 40,
            'null'       => false,
        ),
        'apellido' => array(
            'type'       => 'VARCHAR',
            'constraint' => 30,
            'null'       => false,
        ),
        'direccion' => array(
            'type'       => 'VARCHAR',
            'constraint' => 30,
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
		$this->dbforge->add_key('id_cliente', true);
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