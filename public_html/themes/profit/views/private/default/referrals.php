<?php
$this->pageTitle = 'Referral program';

$this->breadcrumbs=array(
    $this->module->id,
);
?>
<div>

    <table class="items table">
        <tr>
            <td>
                <h6 class="title"><strong>Referral Bonus</strong></h6>
            </td>
            <td>
                8%
            </td>
        </tr>
        <tr>
            <td>
                <h6 class="title"><strong>Your referral link</strong></h6>
            </td>
            <td>
                <?php echo CHtml::textField('ref', Yii::app()->getRequest()->getHostInfo().'/?referral='.$user->id, ['style'=>'color:#217b9d']) ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo CHtml::link('Promotional materials', '#') ?>
            </td>
            <td>

            </td>
        </tr>
    </table>

</div>

<div>
    <div class="title-wrapper">
        <div class="section-title">
            <h4 class="title">Referral Program Information</h4>
        </div>
        <span class="divider"></span>
        <div class="clear"></div>
    </div>
    <table class="items table">
        <tr>
            <td>
                <h6 class="title"><strong>Referred by</strong></h6>
            </td>
            <td>
                <h6><?php  ?></h6>
            </td>
        </tr>
        <tr>
            <td>
                <h6 class="title"><strong>Referrals</strong></h6>
            </td>
            <td>
                <h6><?php  ?></h6>
            </td>
        </tr>
        <tr>
            <td>
                <h6 class="title"><strong>Total Referral Earnings</strong></h6>
            </td>
            <td>
                <h6><?php  ?></h6>
            </td>
        </tr>
        <tr>
            <td>
                <h6 class="title"><strong>Profit from referrals</strong></h6>
            </td>
            <td>
                <h6><?php  ?></h6>
            </td>
        </tr>
    </table>
</div>


<?php if ( Referral::model()->getSumReferrals() > 0 ) : ?>
    <div>
        <div class="title-wrapper">
            <div class="section-title">
                <h4 class="title">History referral payments</h4>
            </div>
            <span class="divider"></span>
            <div class="clear"></div>
        </div>
        <?php $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'user-deposit-grid',
            'dataProvider'=>$referrals->referralSearch(),
            'template' => '{items}{pager}',
            'columns'=>array(
                [
                    'name'=>'ref_id',
                    'headerHtmlOptions' => ['style' => 'text-align:center;'],
                    'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                    'value'=>'User::getСropNameById($data->ref_id)'
                ],
                /*[
                    'name'=>'deposit_amount',
                    'headerHtmlOptions' => ['style' => 'text-align:center;'],
                    'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                    'value'=>'"$".$data->deposit_amount'
                ],
                [
                    'name'=>'date_create',
                    'headerHtmlOptions' => ['style' => 'text-align:center;'],
                    'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                    'value'=>'User::formatDate($data->date_create)'
                ],*/


                /*array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                ),*/
            ),
        )); ?>

    </div>
<?php endif; ?>