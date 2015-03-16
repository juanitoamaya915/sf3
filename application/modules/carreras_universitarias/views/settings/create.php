<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class='alert alert-block alert-error fade in'>
	<a class='close' data-dismiss='alert'>&times;</a>
	<h4 class='alert-heading'>
		<?php echo lang('carreras_universitarias_errors_message'); ?>
	</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

$id = isset($carreras_universitarias->id) ? $carreras_universitarias->id : '';

?>
<div class='admin-box'>
	<h3>Carreras Universitarias</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
            

			<div class="control-group<?php echo form_error('id_carrera') ? ' error' : ''; ?>">
				<?php echo form_label('Id Carrera Universitaria'. lang('bf_form_label_required'), 'id_carrera', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='id_carrera' type='text' required='required' name='id_carrera' maxlength='5' value="<?php echo set_value('id_carrera', isset($carreras_universitarias->id_carrera) ? $carreras_universitarias->id_carrera : ''); ?>" />
					<span class='help-inline'><?php echo form_error('id_carrera'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('nombre_carrera') ? ' error' : ''; ?>">
				<?php echo form_label('Nombre Carrera'. lang('bf_form_label_required'), 'nombre_carrera', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='nombre_carrera' type='text' required='required' name='nombre_carrera' maxlength='20' value="<?php echo set_value('nombre_carrera', isset($carreras_universitarias->nombre_carrera) ? $carreras_universitarias->nombre_carrera : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nombre_carrera'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('numero_semestres') ? ' error' : ''; ?>">
				<?php echo form_label('Numero de semestres', 'numero_semestres', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='numero_semestres' type='text' name='numero_semestres' maxlength='2' value="<?php echo set_value('numero_semestres', isset($carreras_universitarias->numero_semestres) ? $carreras_universitarias->numero_semestres : ''); ?>" />
					<span class='help-inline'><?php echo form_error('numero_semestres'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('numero_tutorias') ? ' error' : ''; ?>">
				<?php echo form_label('Numero de Tutorias', 'numero_tutorias', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='numero_tutorias' type='text' name='numero_tutorias' maxlength='2' value="<?php echo set_value('numero_tutorias', isset($carreras_universitarias->numero_tutorias) ? $carreras_universitarias->numero_tutorias : ''); ?>" />
					<span class='help-inline'><?php echo form_error('numero_tutorias'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('descripcion') ? ' error' : ''; ?>">
				<?php echo form_label('Descripcion', 'descripcion', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='descripcion' type='text' name='descripcion' maxlength='20' value="<?php echo set_value('descripcion', isset($carreras_universitarias->descripcion) ? $carreras_universitarias->descripcion : ''); ?>" />
					<span class='help-inline'><?php echo form_error('descripcion'); ?></span>
				</div>
			</div>
        </fieldset>
		<fieldset class='form-actions'>
			<input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('carreras_universitarias_action_create'); ?>" />
			<?php echo lang('bf_or'); ?>
			<?php echo anchor(SITE_AREA . '/settings/carreras_universitarias', lang('carreras_universitarias_cancel'), 'class="btn btn-warning"'); ?>
			
		</fieldset>
    <?php echo form_close(); ?>
</div>