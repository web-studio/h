<div class="deposits">
    <div id="deposit_alert"></div>
    <?php foreach ( $depositTypes as $depositType ) :?>
        <div class="tree columns alpha deposit" style="margin-left: 20px">
            <ul class="pricing" style="width: 200px; ">
                <li class="title"><?php echo $depositType->name ?></li>
                <li class="price">
                    <span class="rate">Total return</span><br/>
                    <span><?php echo $depositType->total_return ?></span>
                    <span class="decimal">%</span>
                </li>
                <li><strong>Amount</strong> $<?php echo $depositType->min_amount ?> - $<?php echo $depositType->max_amount ?></li>
                <li><strong>Period</strong> <?php echo $depositType->days ?> working days</li>
                <li class="purchase"><div class="button-wrap">
                        <a href="<?php echo Yii::app()->createAbsoluteUrl("/private/default/investment") ?>" class="medium-button button">
                            <span>Invest</span></a></div></li>

            </ul>

        </div>
    <?php endforeach; ?>
</div>

<div class="clear"></div>