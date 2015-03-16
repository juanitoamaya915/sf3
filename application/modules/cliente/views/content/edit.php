<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class='alert alert-block alert-error fade in'>
	<a class='close' data-dismiss='alert'>&times;</a>
	<h4 class='alert-heading'>
		<?php echo lang('cliente_errors_message'); ?>
	</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

$id = isset($cliente->id_cliente) ? $cliente->id_cliente : '';

?>
<div class='admin-box'>
	<h3>cliente</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
            

			<div class="control-group<?php echo form_error('nombre') ? ' error' : ''; ?>">
				<?php echo form_label('nombre'. lang('bf_form_label_required'), 'nombre', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='nombre' type='text' required='required' name='nombre' maxlength='40' value="<?php echo set_value('nombre', isset($cliente->nombre) ? $cliente->nombre : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nombre'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('apellido') ? ' error' : ''; ?>">
				<?php echo form_label('apellido'. lang('bf_form_label_required'), 'apellido', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='apellido' type='text' required='required' name='apellido' maxlength='30' value="<?php echo set_value('apellido', isset($cliente->apellido) ? $cliente->apellido : ''); ?>" />
					<span class='help-inline'><?php echo form_error('apellido'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('direccion') ? ' error' : ''; ?>">
				<?php echo form_label('direccion'. lang('bf_form_label_required'), 'direccion', array('class' => 'control-label')); ?>
				<div class='controls'>
					<input id='direccion' type='text' required='required' name='direccion' maxlength='30' value="<?php echo set_value('direccion', isset($cliente->direccion) ? $cliente->direccion : ''); ?>" />
					<span class='help-inline'><?php echo form_error('direccion'); ?></span>
				</div>
			</div>
        </fieldset>
		<fieldset class='form-actions'>
			<input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('cliente_action_edit'); ?>" />
			<?php echo lang('bf_or'); ?>
			<?php echo anchor(SITE_AREA . '/content/cliente', lang('cliente_cancel'), 'class="btn btn-warning"'); ?>
			
			<?php if ($this->auth->has_permission('Cliente.Content.Delete')) : ?>
				<?php echo lang('bf_or'); ?>
				<button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('cliente_delete_confirm'))); ?>');">
					<span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('cliente_delete_record'); ?>
				</button>
			<?php endif; ?>
		</fieldset>
    <?php echo form_close(); ?>
</div>