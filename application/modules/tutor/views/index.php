<?php

$hiddenFields = array('id_tutor',);
?>
<h1 class='page-header'>
    <?php echo lang('tutor_area_title'); ?>
</h1>
<?php if (isset($records) && is_array($records) && count($records)) : ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            
            <th>Nombre Tutor</th>
            <th>Apellido Tutor</th>
            <th>Correo Electronico</th>
            <th>Direccion Tutor</th>
            <th>Celular Tutor</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($records as $record) :
        ?>
        <tr>
            <?php
            foreach($record as $field => $value) :
                if ( ! in_array($field, $hiddenFields)) :
            ?>
            <td>
                <?php
                if ($field == 'deleted') {
                    e(($value > 0) ? lang('tutor_true') : lang('tutor_false'));
                } else {
                    e($value);
                }
                ?>
            </td>
            <?php
                endif;
            endforeach;
            ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php

endif; ?>