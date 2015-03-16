<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_pensum extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'pensum';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'codigo_pensum' => array(
            'type'       => 'VARCHAR',
            'constraint' => 5,
            'null'       => false,
        ),
        'fecha' => array(
            'type'       => 'DATE',
            'null'       => true,
            'default'    => '0000-00-00',
        ),
        'id_carrera_universitaria' => array(
            'type'       => 'VARCHAR',
            'constraint' => 5,
            'null'       => false,
        ),
        'descripcion' => array(
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'null'       => true,
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
		$this->dbforge->add_key('id', true);
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