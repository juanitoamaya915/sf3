<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class='alert alert-block alert-error fade in'>
	<a class='close' data-dismiss='alert'>&times;</a>
	<h4 class='alert-heading'>
		<?php echo lang('tutoria_errors_message'); ?>
	</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

$id = isset($tutoria->id) ? $tutoria->id : '';

?>
<div class='admin-box'>
	<h3>Tutoria</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
            

			<div class="control-group<?php echo form_error('cadigo_tutoria') ? ' error' : ''; ?>">
				<?php echo form_label('codigo Tutoria'. lang('bf_form_label_required'), 'cadigo_tutoria', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='cadigo_tutoria' type='text' required='required' name='cadigo_tutoria' maxlength='5' value="<?php echo set_value('cadigo_tutoria', isset($tutoria->cadigo_tutoria) ? $tutoria->cadigo_tutoria : ''); ?>" />
					<span class='help-inline'><?php echo form_error('cadigo_tutoria'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('tutoria') ? ' error' : ''; ?>">
				<?php echo form_label('Tutoria'. lang('bf_form_label_required'), 'tutoria', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='tutoria' type='text' required='required' name='tutoria' maxlength='30' value="<?php echo set_value('tutoria', isset($tutoria->tutoria) ? $tutoria->tutoria : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tutoria'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('id_tutor') ? ' error' : ''; ?>">
				<?php echo form_label('Tutor'. lang('bf_form_label_required'), 'id_tutor', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='id_tutor' type='text' required='required' name='id_tutor' maxlength='5' value="<?php echo set_value('id_tutor', isset($tutoria->id_tutor) ? $tutoria->id_tutor : ''); ?>" />
					<span class='help-inline'><?php echo form_error('id_tutor'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('id_pensum') ? ' error' : ''; ?>">
				<?php echo form_label('Pensum'. lang('bf_form_label_required'), 'id_pensum', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='id_pensum' type='text' required='required' name='id_pensum' maxlength='5' value="<?php echo set_value('id_pensum', isset($tutoria->id_pensum) ? $tutoria->id_pensum : ''); ?>" />
					<span class='help-inline'><?php echo form_error('id_pensum'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('jornada') ? ' error' : ''; ?>">
				<?php echo form_label('Jornada'. lang('bf_form_label_required'), 'jornada', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='jornada' type='text' required='required' name='jornada' maxlength='6' value="<?php echo set_value('jornada', isset($tutoria->jornada) ? $tutoria->jornada : ''); ?>" />
					<span class='help-inline'><?php echo form_error('jornada'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('horario') ? ' error' : ''; ?>">
				<?php echo form_label('Horario'. lang('bf_form_label_required'), 'horario', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='horario' type='text' required='required' name='horario' maxlength='15' value="<?php echo set_value('horario', isset($tutoria->horario) ? $tutoria->horario : ''); ?>" />
					<span class='help-inline'><?php echo form_error('horario'); ?></span>
				</div>
			</div>
        </fieldset>
		<fieldset class='form-actions'>
			<input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('tutoria_action_create'); ?>" />
			<?php echo lang('bf_or'); ?>
			<?php echo anchor(SITE_AREA . '/reports/tutoria', lang('tutoria_cancel'), 'class="btn btn-warning"'); ?>
			
		</fieldset>
    <?php echo form_close(); ?>
</div>