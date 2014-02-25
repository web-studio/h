<?php
$this->pageTitle = 'Promo materials';

$this->breadcrumbs=array(
    'My account'=>array('/private'),
    'Referral program'=>array('/private/default/referrals'),
    $this->pageTitle
);
?>

<div class="promo_materials">

    <img src="<?php echo Yii::app()->getRequest()->getHostInfo().'/images/promo/125x125.png' ?>" /><br />
    <textarea cols="30" rows="10"><a href="<?php echo Yii::app()->getRequest()->getHostInfo().'/?partner='.$user->id ?>" title="<?php echo Yii::app()->name; ?>">
<img src="<?php echo Yii::app()->getRequest()->getHostInfo().'/images/promo/125x125.png' ?>" />
</a></textarea>

    <span class="hr"></span>

    <img src="<?php echo Yii::app()->getRequest()->getHostInfo().'/images/promo/240x400.png' ?>" /><br />
    <textarea cols="30" rows="10"><a href="<?php echo Yii::app()->getRequest()->getHostInfo().'/?partner='.$user->id ?>" title="<?php echo Yii::app()->name; ?>">
<img src="<?php echo Yii::app()->getRequest()->getHostInfo().'/images/promo/240x400.png' ?>" />
</a></textarea>

    <span class="hr"></span>

    <img src="<?php echo Yii::app()->getRequest()->getHostInfo().'/images/promo/468x70.png' ?>" /><br />
    <textarea cols="30" rows="10"><a href="<?php echo Yii::app()->getRequest()->getHostInfo().'/?partner='.$user->id ?>" title="<?php echo Yii::app()->name; ?>">
<img src="<?php echo Yii::app()->getRequest()->getHostInfo().'/images/promo/468x70.png' ?>" />
</a></textarea>
    <span class="hr"></span>
</div>
