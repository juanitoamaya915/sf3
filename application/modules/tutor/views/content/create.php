<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class='alert alert-block alert-error fade in'>
	<a class='close' data-dismiss='alert'>&times;</a>
	<h4 class='alert-heading'>
		<?php echo lang('tutor_errors_message'); ?>
	</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

$id = isset($tutor->id_tutor) ? $tutor->id_tutor : '';

?>
<div class='admin-box'>
	<h3>Tutor</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
            

			<div class="control-group<?php echo form_error('nombre_tutor') ? ' error' : ''; ?>">
				<?php echo form_label('Nombre Tutor'. lang('bf_form_label_required'), 'nombre_tutor', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='nombre_tutor' type='text' required='required' name='nombre_tutor' maxlength='20' value="<?php echo set_value('nombre_tutor', isset($tutor->nombre_tutor) ? $tutor->nombre_tutor : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nombre_tutor'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('apellido_tutor') ? ' error' : ''; ?>">
				<?php echo form_label('Apellido Tutor'. lang('bf_form_label_required'), 'apellido_tutor', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='apellido_tutor' type='text' required='required' name='apellido_tutor' maxlength='20' value="<?php echo set_value('apellido_tutor', isset($tutor->apellido_tutor) ? $tutor->apellido_tutor : ''); ?>" />
					<span class='help-inline'><?php echo form_error('apellido_tutor'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('correo_electronico') ? ' error' : ''; ?>">
				<?php echo form_label('Correo Electronico'. lang('bf_form_label_required'), 'correo_electronico', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='correo_electronico' type='text' required='required' name='correo_electronico' maxlength='20' value="<?php echo set_value('correo_electronico', isset($tutor->correo_electronico) ? $tutor->correo_electronico : ''); ?>" />
					<span class='help-inline'><?php echo form_error('correo_electronico'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('direccion_tutor') ? ' error' : ''; ?>">
				<?php echo form_label('Direccion Tutor', 'direccion_tutor', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='direccion_tutor' type='text' name='direccion_tutor' maxlength='20' value="<?php echo set_value('direccion_tutor', isset($tutor->direccion_tutor) ? $tutor->direccion_tutor : ''); ?>" />
					<span class='help-inline'><?php echo form_error('direccion_tutor'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('celular_tutor') ? ' error' : ''; ?>">
				<?php echo form_label('Celular Tutor'. lang('bf_form_label_required'), 'celular_tutor', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='celular_tutor' type='text' required='required' name='celular_tutor' maxlength='10' value="<?php echo set_value('celular_tutor', isset($tutor->celular_tutor) ? $tutor->celular_tutor : ''); ?>" />
					<span class='help-inline'><?php echo form_error('celular_tutor'); ?></span>
				</div>
			</div>
        </fieldset>
		<fieldset class='form-actions'>
			<input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('tutor_action_create'); ?>" />
			<?php echo lang('bf_or'); ?>
			<?php echo anchor(SITE_AREA . '/content/tutor', lang('tutor_cancel'), 'class="btn btn-warning"'); ?>
			
		</fieldset>
    <?php echo form_close(); ?>
</div>