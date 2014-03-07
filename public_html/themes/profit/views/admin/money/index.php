<p>
    Overall balance users:
    <span class='stat-value'><?php echo User::model()->allAmount; ?>$</span>
</p>


<h3>List closure deposits <a href='javascript:;' onclick="$('#form').show(300);" id='day' title='Click to change'>
        <?php echo $this->expirationDate; ?></a> <?php echo User::model()->declension($this->expirationDate, ' day', ' day', ' days')?>:</h3>
<div id='form' style='display:none'>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'day-form',
        'enableAjaxValidation'=>false,
    )); ?>
    <?php echo CHtml::textField('day',''); ?>
    <?php echo CHtml::submitButton('Изменить', array('class' => 'btn btn-large')); ?>
    <?php $this->endWidget(); ?>
</div>
<table class='table table-bordered table-striped'>
    <thead>
    <tr>
        <td>Дата</td><td>Сумма</td>
    </tr>
    </thead>
    <?php foreach( $deps as $deposit ) : ?>
        <tr>
            <td><?php echo date("d.m.Y", strtotime($deposit['expire'])) ?></td>
            <td><?php echo $deposit['amount'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>