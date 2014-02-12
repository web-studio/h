<div class="title-wrapper">
    <div class="section-title">
        <h4 class="title">My transactions</h4>
    </div>
    <span class="divider"></span>
    <div class="clear"></div>
</div>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'user-transactions-grid',
    'dataProvider'=>$userTransactions->transactionSearch(),
    'template' => '{items}{pager}',
    'filter'=>$userTransactions,
    'columns'=>array(

        [
            'name'=>'amount',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'( $data->amount < 0 ) ? "-$" . substr($data->amount,1) : "$" . $data->amount',
            'filter' => false,
        ],
        [
            'name'=>'amount_type',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'UserTransactions::getAmountTypeName($data->amount_type)',
            'filter' => CHtml::activeDropDownList($userTransactions, 'amount_type', UserTransactions::getListAmountTypeName(), ['empty'=>'All transactions']),
        ],
        [
            'name'=>'time',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'User::formatDate($data->time,true)',
            'filter' => false,
        ],
        [
            'name'=>'amount_after',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'"$" . $data->amount_after',
            'filter' => false,
        ],
        [
            'name'=>'reason',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'$data->reason',
            'filter' => false,
        ],


        /*array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),*/
    ),
)); ?>