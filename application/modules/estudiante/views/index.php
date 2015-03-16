<?php

$hiddenFields = array('id',);
?>
<h1 class='page-header'>
    <?php echo lang('estudiante_area_title'); ?>
</h1>
<?php if (isset($records) && is_array($records) && count($records)) : ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            
            <th>Codigo Estudiante</th>
            <th>Nombre Estudiante</th>
            <th>Apellido Estudiante</th>
            <th>Dirrecion</th>
            <th>Correo Electronico</th>
            <th>Celular</th>
            <th>Carrera Universitaria</th>
            <th>Encuesta Tutor</th>
            <th>Encuesta Institucional</th>
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
                    e(($value > 0) ? lang('estudiante_true') : lang('estudiante_false'));
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