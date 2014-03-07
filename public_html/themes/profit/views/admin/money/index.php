<table class="items table">
        <thead>
            <th>Purse</th><th>Amount</th>
        </thead>
    <?php foreach ( $balances as $purse=>$value ) : ?>
        <tr>
            <td><?= $purse ?></td><td><?= $value ?></td>
        </tr>
    <?php endforeach ?>

</table>

<p>
    <strong>Overall balance users:</strong>
    <span class='stat-value'>$<?php echo User::model()->allAmount; ?></span>
</p>



<div id='form'>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'day-form',
        'enableAjaxValidation'=>false,
    )); ?>
    <strong>List of deposits by the end of</strong>
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'id' => 'day',
        'name' => 'day',
        'value' => $date,
        'language' => 'ru',
        // additional javascript options for the date picker plugin
        'options' => array(
            'showAnim' => 'fold',
            'changeMonth' => true,
            'changeYear' => true,
            'dateFormat' => 'yy-mm-dd',
            'minDate' => 'new Date',
            'beforeShow' => "js:function() {
                    $('.ui-datepicker').css('font-size', '0.9em');
                    $('.ui-datepicker-div').css('z-index', 9999);
            }",
            'onSelect' => "js:function() {

                   $('#day-form').submit();
            }",
        ),
        'htmlOptions' => array(

            'class' => 'input-small input-mask-date',
            'style'=>'cursor:pointer; background-color: transparent; padding:0 1px 0 1px;margin:0 0 3px 2px;border-top:0;border-left:0;border-right:0;border-bottom: 1px dashed #217b9d;box-shadow:none;color:#217b9d;width:75px;font-weight:bold'
        ),
    )); ?>
    <?php $this->endWidget(); ?>
</div>


<table class='table table-bordered table-striped'>
    <thead>

        <th>Date</th><th>Amount</th>

    </thead>
    <?php foreach( $deps as $deposit ) : ?>
        <tr>
            <td><?php echo date("d.m.Y", strtotime($deposit['expire'])) ?></td>
            <td><?php echo $deposit['amount'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>