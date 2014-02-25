<?php
$this->pageTitle = 'Referral program';

$this->breadcrumbs=array(
    'My account'=>array('/private'),
    $this->pageTitle
);
?>
<div>

    <table class="items table">
        <tr>
            <td>
                <h6 class="title"><strong>Your referral Bonus</strong></h6>
            </td>
            <td>
                <?php echo Referral::model()->getReferralBonus() ?>
            </td>
        </tr>
        <tr>
            <td>
                <h6 class="title"><strong>Your referral link</strong></h6>
            </td>
            <td>
                <?php echo CHtml::textField('ref', Yii::app()->getRequest()->getHostInfo().'/?partner='.$user->id, ['style'=>'color:#217b9d;width:380px']) ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo CHtml::link('Promotional materials', Yii::app()->createAbsoluteUrl('/private/default/promotionalMaterials')) ?>
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
        <?php $referredBy = User::model()->isReferral(); ?>
        <?php if ( !empty($referredBy) ) : ?>
            <tr>
                <td>
                    <h6 class="title"><strong>Referred by</strong></h6>
                </td>
                <td>
                    <h6><?php echo User::getСropNameById($referredBy['user_id']) ?></h6>
                </td>
            </tr>
        <?php endif ?>
        <tr>
            <td>
                <h6 class="title"><strong>Referrals</strong></h6>
            </td>
            <td>
                <h6>
                    <?php
                    $sumReferrals = Referral::model()->getSumReferrals();
                    echo $sumReferrals;
                    ?>
                </h6>
            </td>
        </tr>
        <tr>
            <td>
                <h6 class="title"><strong>Total Referral Earnings</strong></h6>
            </td>
            <td>
                <h6>$<?php echo Referral::model()->getTotalReferralProfit() ?></h6>
            </td>
        </tr>

    </table>
</div>


<?php if ( $sumReferrals > 0 ) : ?>
    <div>
        <div class="title-wrapper">
            <div class="section-title">
                <h4 class="title">History referral payments</h4>
            </div>
            <span class="divider"></span>
            <div class="clear"></div>
        </div>
        <table class="items table">
            <thead>
                <th style="text-align:center;">
                    Referral
                </th>
                <th style="text-align:center;">
                    Invested
                </th>
                <th style="text-align:center;">
                    Referral profit
                </th>
            </thead>
            <?php foreach ( $referrals as $referral ) : ?>
                <tr>
                    <td style="text-align:center;vertical-align:middle"><?php echo User::getСropNameById($referral['ref_id']) ?></td>
                    <td style="text-align:center;vertical-align:middle">$<?php echo UserDeposit::model()->getAmountFirstDeposit($referral['ref_id']) ?></td>
                    <td style="text-align:center;vertical-align:middle">$<?php echo Referral::model()->getReferralProfit($referral['ref_id']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>