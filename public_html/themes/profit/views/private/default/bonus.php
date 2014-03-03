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
                <td class="">
                    <?php echo CHtml::textField($site['id'], '', ['class'=>'link-text-field']) ?>
                    <?php echo CHtml::button('Send', ['class'=>'submit_button', 'id'=>'send', 'style'=>'display:none']); ?>
                    <span class="messages"></span>
                </td>
            </tr>
    <?php endforeach; ?>
        </table>
    <!--div class="center">
        <?php echo CHtml::submitButton('Send', ['class'=>'submit_button', 'id'=>'send']); ?>
    </div-->
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

<script>
    $(document).ready(function() {
        $(document).bind('paste', function(e) {
            if ( $(this).val().length > 10 ) {
                $(this).siblings('.submit_button').show();
                $(this).siblings('.messages').html('');
            } else {
                $(this).siblings('.submit_button').hide();
                $(this).siblings('.messages').html('');
            }
        });
        $('.link-text-field').on('keyup', function(e) {

            if ( $(this).val().length > 10 ) {
                $(this).siblings('.submit_button').show();
                $(this).siblings('.messages').html('');
            } else {
                $(this).siblings('.submit_button').hide();
                $(this).siblings('.messages').html('');
            }
        });

        $('.submit_button').on('click', function(){
            var link = $(this).siblings('.link-text-field').val();
            var site_id = $(this).siblings('.link-text-field').attr('id');
            var btn = $(this);

            $.ajax({
                url: '<?php echo Yii::app()->createAbsoluteUrl('/private/ajax/bonusLink') ?>',
                dataType: 'json',
                type: 'post',
                beforeSend: function(){
                    btn.hide();
                    btn.siblings('.messages').css({'color':'green'}).html('sending...');
                },
                data: {link: link, site_id: site_id},
                success: function(data) {
                    if ( data.errors == 0 ) {
                        //btn.siblings('.messages').css({'color':'green'}).html('Ok');
                        var td = btn.parent('td');
                        var tr = td.parent('tr');
                        tr.css("background-color","#7AD2A7");
                        tr.fadeOut(600, function(){
                            tr.remove();
                        });
                        $('#bonus-grid').yiiGridView("update");
                    } else {
                        btn.siblings('.messages').css({'color':'red'}).html(data.code);
                    }
                }
            });
        });
    });
</script>