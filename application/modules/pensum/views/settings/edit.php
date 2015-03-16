<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class='alert alert-block alert-error fade in'>
	<a class='close' data-dismiss='alert'>&times;</a>
	<h4 class='alert-heading'>
		<?php echo lang('pensum_errors_message'); ?>
	</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

$id = isset($pensum->id) ? $pensum->id : '';

?>
<div class='admin-box'>
	<h3>Pensum</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
            

			<div class="control-group<?php echo form_error('codigo_pensum') ? ' error' : ''; ?>">
				<?php echo form_label('Codigo Pensum'. lang('bf_form_label_required'), 'codigo_pensum', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='codigo_pensum' type='text' required='required' name='codigo_pensum' maxlength='5' value="<?php echo set_value('codigo_pensum', isset($pensum->codigo_pensum) ? $pensum->codigo_pensum : ''); ?>" />
					<span class='help-inline'><?php echo form_error('codigo_pensum'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('fecha') ? ' error' : ''; ?>">
				<?php echo form_label('Fecha', 'fecha', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='fecha' type='text' name='fecha'  value="<?php echo set_value('fecha', isset($pensum->fecha) ? $pensum->fecha : ''); ?>" />
					<span class='help-inline'><?php echo form_error('fecha'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('id_carrera_universitaria') ? ' error' : ''; ?>">
				<?php echo form_label('Carrera Universitaria'. lang('bf_form_label_required'), 'id_carrera_universitaria', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='id_carrera_universitaria' type='text' required='required' name='id_carrera_universitaria' maxlength='5' value="<?php echo set_value('id_carrera_universitaria', isset($pensum->id_carrera_universitaria) ? $pensum->id_carrera_universitaria : ''); ?>" />
					<span class='help-inline'><?php echo form_error('id_carrera_universitaria'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('descripcion') ? ' error' : ''; ?>">
				<?php echo form_label('descripcion', 'descripcion', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='descripcion' type='text' name='descripcion' maxlength='20' value="<?php echo set_value('descripcion', isset($pensum->descripcion) ? $pensum->descripcion : ''); ?>" />
					<span class='help-inline'><?php echo form_error('descripcion'); ?></span>
				</div>
			</div>
        </fieldset>
		<fieldset class='form-actions'>
			<input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('pensum_action_edit'); ?>" />
			<?php echo lang('bf_or'); ?>
			<?php echo anchor(SITE_AREA . '/settings/pensum', lang('pensum_cancel'), 'class="btn btn-warning"'); ?>
			
			<?php if ($this->auth->has_permission('Pensum.Settings.Delete')) : ?>
				<?php echo lang('bf_or'); ?>
				<button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('pensum_delete_confirm'))); ?>');">
					<span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('pensum_delete_record'); ?>
				</button>
			<?php endif; ?>
		</fieldset>
    <?php echo form_close(); ?>
</div>