<p>
    Overall balance users:
    <span class='stat-value'><?php echo User::model()->allAmount; ?>$</span>
</p>



<div id='form'>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'day-form',
        'enableAjaxValidation'=>false,
    )); ?>
    List of deposits by the end of
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
            //'showOtherMonths'=>true,
            //'language' => Yii::app()->getLanguage(),
            'dateFormat' => 'yy-mm-dd',
            //'showButtonPanel' => true,
            //'showOn' => 'both',
            //'buttonImageOnly' => true,
            'beforeShow' => "js:function() {

                    $('.ui-datepicker-div').css('z-index', 9999);
            }",
            'onSelect' => "js:function() {

                   $('#day-form').submit();
            }",
        ),
        'htmlOptions' => array(

            'class' => 'input-small input-mask-date',

        ),
    )); ?>
    <?php $this->endWidget(); ?>
</div>


<table class='table table-bordered table-striped'>
    <thead>
    <tr>
        <td>Date</td><td>Amount</td>
    </tr>
    </thead>
    <?php foreach( $deps as $deposit ) : ?>
        <tr>
            <td><?php echo date("d.m.Y", strtotime($deposit['expire'])) ?></td>
            <td><?php echo $deposit['amount'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>