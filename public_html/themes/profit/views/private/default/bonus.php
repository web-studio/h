<?php
$this->pageTitle = 'Bonus Program';

$this->breadcrumbs=array(
    'My account'=>array('/private'),
    $this->pageTitle
);
?>

<?php if ( !empty($sites) ) : ?>
<div class="title-wrapper">
    <div class="section-title">
        <h4 class="title">For every post you get 8% of the daily payments.</h4>
    </div>
    <span class="divider"></span>
    <div class="clear"></div>
</div>
    <span>Insert links to sites by appropriate field.</span>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'bonus-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
    <table class="items table">

    <?php foreach ( $sites as $site ) : ?>
            <tr>
                <td>
                    <?php echo $site['url'] ?>
                </td>
                <td>
                    <?php echo CHtml::textField($site['id'], '') ?>
                </td>
            </tr>
    <?php endforeach; ?>
        </table>
    <div class="center">
        <?php echo CHtml::submitButton('Send', ['class'=>'submit_button', 'id'=>'send']); ?>
    </div>
<?php $this->endWidget(); ?>
<?php endif ?>

<?php if ( $bonusProgram->bonusSearch()->itemCount > 0 ):?>
    <div class="title-wrapper">
        <div class="section-title">
            <h4 class="title">Bonus Program Details</h4>
        </div>
        <span class="divider"></span>
        <div class="clear"></div>
    </div>
    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'bonus-grid',
        'dataProvider'=>$bonusProgram->bonusSearch(),
        'template' => '{items}{pager}',
        'columns'=>array(

            [
                'name'=>'date_create',
                'headerHtmlOptions' => ['style' => 'text-align:center;'],
                'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                'value'=>'User::formatDate($data->date_create,true)'
            ],
            [
                'name'=>'link',
                'headerHtmlOptions' => ['style' => 'text-align:center;'],
                'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                'value'=>'$data->link'
            ],
            [
                'name'=>'status',
                'headerHtmlOptions' => ['style' => 'text-align:center;'],
                'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                'value'=>'BonusProgram::model()->getStatus($data->status)'
            ],

        ),
    )); ?>
<?php endif?>