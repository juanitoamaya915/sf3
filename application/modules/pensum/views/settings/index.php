<?php

$num_columns	= 4;
$can_delete	= $this->auth->has_permission('Pensum.Settings.Delete');
$can_edit		= $this->auth->has_permission('Pensum.Settings.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('pensum_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('pensum_field_codigo_pensum'); ?></th>
					<th><?php echo lang('pensum_field_fecha'); ?></th>
					<th><?php echo lang('pensum_field_id_carrera_universitaria'); ?></th>
					<th><?php echo lang('pensum_field_descripcion'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('pensum_delete_confirm'))); ?>')" />
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
					<td class='column-check'><input type='checkbox' name='checked[]' value='<?php echo $record->id; ?>' /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/settings/pensum/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->codigo_pensum); ?></td>
				<?php else : ?>
					<td><?php e($record->codigo_pensum); ?></td>
				<?php endif; ?>
					<td><?php e($record->fecha); ?></td>
					<td><?php e($record->id_carrera_universitaria); ?></td>
					<td><?php e($record->descripcion); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('pensum_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    ?>
</div>