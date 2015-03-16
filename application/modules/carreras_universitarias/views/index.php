<?php

$hiddenFields = array('id',);
?>
<h1 class='page-header'>
    <?php echo lang('carreras_universitarias_area_title'); ?>
</h1>
<?php if (isset($records) && is_array($records) && count($records)) : ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            
            <th>Id Carrera Universitaria</th>
            <th>Nombre Carrera</th>
            <th>Numero de semestres</th>
            <th>Numero de Tutorias</th>
            <th>Descripcion</th>
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
                    e(($value > 0) ? lang('carreras_universitarias_true') : lang('carreras_universitarias_false'));
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