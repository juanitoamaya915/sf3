<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_tutoria extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'tutoria';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'cadigo_tutoria' => array(
            'type'       => 'VARCHAR',
            'constraint' => 5,
            'null'       => false,
        ),
        'tutoria' => array(
            'type'       => 'VARCHAR',
            'constraint' => 30,
            'null'       => false,
        ),
        'id_tutor' => array(
            'type'       => 'VARCHAR',
            'constraint' => 5,
            'null'       => false,
        ),
        'id_pensum' => array(
            'type'       => 'VARCHAR',
            'constraint' => 5,
            'null'       => false,
        ),
        'jornada' => array(
            'type'       => 'VARCHAR',
            'constraint' => 6,
            'null'       => false,
        ),
        'horario' => array(
            'type'       => 'VARCHAR',
            'constraint' => 15,
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