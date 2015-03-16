<?php

$num_columns	= 6;
$can_delete	= $this->auth->has_permission('Tutor.Content.Delete');
$can_edit		= $this->auth->has_permission('Tutor.Content.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('tutor_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('tutor_field_nombre_tutor'); ?></th>
					<th><?php echo lang('tutor_field_apellido_tutor'); ?></th>
					<th><?php echo lang('tutor_field_correo_electronico'); ?></th>
					<th><?php echo lang('tutor_field_direccion_tutor'); ?></th>
					<th><?php echo lang('tutor_field_celular_tutor'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('tutor_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php if ($can_delete) : ?>
					<td class='column-check'><input type='checkbox' name='checked[]' value='<?php echo $record->id_tutor; ?>' /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/content/tutor/edit/' . $record->id_tutor, '<span class="icon-pencil"></span> ' .  $record->nombre_tutor); ?></td>
				<?php else : ?>
					<td><?php e($record->nombre_tutor); ?></td>
				<?php endif; ?>
					<td><?php e($record->apellido_tutor); ?></td>
					<td><?php e($record->correo_electronico); ?></td>
					<td><?php e($record->direccion_tutor); ?></td>
					<td><?php e($record->celular_tutor); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('tutor_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    ?>
</div>