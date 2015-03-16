<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_estudiantes extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'estudiantes';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'codigo_estudiante' => array(
            'type'       => 'VARBINARY',
            'constraint' => 10,
            'null'       => false,
        ),
        'nombre_estudiante' => array(
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'null'       => false,
        ),
        'apellido_estudiante' => array(
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'null'       => false,
        ),
        'direccion' => array(
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'null'       => true,
        ),
        'correo_electronico' => array(
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'null'       => false,
        ),
        'celular' => array(
            'type'       => 'VARCHAR',
            'constraint' => 10,
            'null'       => false,
        ),
        'id_carrera' => array(
            'type'       => 'VARCHAR',
            'constraint' => 5,
            'null'       => false,
        ),
        'encuesta_tutor' => array(
            'type'       => 'BOOLEAN',
            'null'       => false,
        ),
        'encuesta_Institucional' => array(
            'type'       => 'BOOLEAN',
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