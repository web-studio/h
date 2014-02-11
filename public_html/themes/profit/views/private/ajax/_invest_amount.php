<?php $amount = 350; ?>
<span style="font-weight: bold; font-size: 24px">Invest amount: </span>
<span style="color:#217b9d; font-weight:bold;font-size: 24px;">$</span>
<input type="text" value="<?php echo $amount ?>" id="amt" style="padding-left:0;border:1px solid #d3d3d3; color:#217b9d; font-weight:bold;font-size: 24px; height: 30px; width: 100px; background-color: transparent" />
<div class="clear"></div>
<?php
$this->widget('zii.widgets.jui.CJuiSlider', array(
    'value'=>$amount,
    'id'=>'amtSlider',
    // additional javascript options for the slider plugin
    'options'=>array(
        'min'=>$deposit['min_amount'],
        'max'=>$deposit['max_amount'],
        'slide'=>'js:function(event, ui) { $("#amt").val(ui.value);}'
    ),
    'htmlOptions'=>array(
        'style'=>'height:12px;width:300px;margin-bottom: 20px',
        //'class'=>'five columns'
    ),
));
?>
<div class="clear"></div>