<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class='alert alert-block alert-error fade in'>
	<a class='close' data-dismiss='alert'>&times;</a>
	<h4 class='alert-heading'>
		<?php echo lang('estudiante_errors_message'); ?>
	</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

$id = isset($estudiante->id) ? $estudiante->id : '';

?>
<div class='admin-box'>
	<h3>Estudiante</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
            

			<div class="control-group<?php echo form_error('codigo_estudiante') ? ' error' : ''; ?>">
				<?php echo form_label('Codigo Estudiante'. lang('bf_form_label_required'), 'codigo_estudiante', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='codigo_estudiante' type='text' required='required' name='codigo_estudiante' maxlength='10' value="<?php echo set_value('codigo_estudiante', isset($estudiante->codigo_estudiante) ? $estudiante->codigo_estudiante : ''); ?>" />
					<span class='help-inline'><?php echo form_error('codigo_estudiante'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('nombre_estudiante') ? ' error' : ''; ?>">
				<?php echo form_label('Nombre Estudiante'. lang('bf_form_label_required'), 'nombre_estudiante', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='nombre_estudiante' type='text' required='required' name='nombre_estudiante' maxlength='20' value="<?php echo set_value('nombre_estudiante', isset($estudiante->nombre_estudiante) ? $estudiante->nombre_estudiante : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nombre_estudiante'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('apellido_estudiante') ? ' error' : ''; ?>">
				<?php echo form_label('Apellido Estudiante'. lang('bf_form_label_required'), 'apellido_estudiante', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='apellido_estudiante' type='text' required='required' name='apellido_estudiante' maxlength='20' value="<?php echo set_value('apellido_estudiante', isset($estudiante->apellido_estudiante) ? $estudiante->apellido_estudiante : ''); ?>" />
					<span class='help-inline'><?php echo form_error('apellido_estudiante'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('direccion') ? ' error' : ''; ?>">
				<?php echo form_label('Dirrecion', 'direccion', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='direccion' type='text' name='direccion' maxlength='20' value="<?php echo set_value('direccion', isset($estudiante->direccion) ? $estudiante->direccion : ''); ?>" />
					<span class='help-inline'><?php echo form_error('direccion'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('correo_electronico') ? ' error' : ''; ?>">
				<?php echo form_label('Correo Electronico'. lang('bf_form_label_required'), 'correo_electronico', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='correo_electronico' type='text' required='required' name='correo_electronico' maxlength='20' value="<?php echo set_value('correo_electronico', isset($estudiante->correo_electronico) ? $estudiante->correo_electronico : ''); ?>" />
					<span class='help-inline'><?php echo form_error('correo_electronico'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('celular') ? ' error' : ''; ?>">
				<?php echo form_label('Celular'. lang('bf_form_label_required'), 'celular', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='celular' type='text' required='required' name='celular' maxlength='10' value="<?php echo set_value('celular', isset($estudiante->celular) ? $estudiante->celular : ''); ?>" />
					<span class='help-inline'><?php echo form_error('celular'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('id_carrera') ? ' error' : ''; ?>">
				<?php echo form_label('Carrera Universitaria'. lang('bf_form_label_required'), 'id_carrera', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='id_carrera' type='text' required='required' name='id_carrera' maxlength='5' value="<?php echo set_value('id_carrera', isset($estudiante->id_carrera) ? $estudiante->id_carrera : ''); ?>" />
					<span class='help-inline'><?php echo form_error('id_carrera'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('encuesta_tutor') ? ' error' : ''; ?>">
				<?php echo form_label('Encuesta Tutor'. lang('bf_form_label_required'), 'encuesta_tutor', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='encuesta_tutor' type='text' required='required' name='encuesta_tutor'  value="<?php echo set_value('encuesta_tutor', isset($estudiante->encuesta_tutor) ? $estudiante->encuesta_tutor : ''); ?>" />
					<span class='help-inline'><?php echo form_error('encuesta_tutor'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('encuesta_Institucional') ? ' error' : ''; ?>">
				<?php echo form_label('Encuesta Institucional'. lang('bf_form_label_required'), 'encuesta_Institucional', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='encuesta_Institucional' type='text' required='required' name='encuesta_Institucional'  value="<?php echo set_value('encuesta_Institucional', isset($estudiante->encuesta_Institucional) ? $estudiante->encuesta_Institucional : ''); ?>" />
					<span class='help-inline'><?php echo form_error('encuesta_Institucional'); ?></span>
				</div>
			</div>
        </fieldset>
		<fieldset class='form-actions'>
			<input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('estudiante_action_create'); ?>" />
			<?php echo lang('bf_or'); ?>
			<?php echo anchor(SITE_AREA . '/settings/estudiante', lang('estudiante_cancel'), 'class="btn btn-warning"'); ?>
			
		</fieldset>
    <?php echo form_close(); ?>
</div>