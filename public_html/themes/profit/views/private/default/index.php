<?php
$this->pageTitle = 'My account';

$this->breadcrumbs=array(
    'My account',
);

?>

<div>

<div class="title-wrapper">
    <div class="section-title">
        <h4 class="title">Personal Information</h4>
    </div>
    <span class="divider"></span>
    <div class="clear"></div>
</div>
<table class="items table">
    <tr>
        <td>
            <h6 class="title"><strong>Full name</strong></h6>
        </td>
        <td>
            <h6><?php echo $user->first_name .' '. $user->last_name ?></h6>
        </td>
    </tr>
    <tr>
        <td>
            <h6 class="title"><strong>Email</strong></h6>
        </td>
        <td>
            <h6><?php echo $user->email ?></h6>
        </td>
    </tr>
    <tr>
        <td>
            <h6 class="title"><strong>Password</strong></h6>
        </td>
        <td>
            <h6><?php echo CHtml::link('Edit','#',
                    ['id'=>'edit_password','style'=>'margin-left:20px','class' => '']) ?></h6>
        </td>
    </tr>
    <tr>
        <td>
            <h6 class="title"><strong>Internal purse</strong></h6>
        </td>
        <td>
            <h6><?php echo $user->internal_purse ?></h6>
        </td>
    </tr>
    <tr>
        <td>
            <h6 class="title"><strong>Perfect money account</strong></h6>
        </td>
        <td>
            <h6> <span id="perfect" style="color:#454545"><?php echo $user->perfect_purse ?></span> <?php echo CHtml::link('Edit', '#',[

                    'id'=>'edit_perfect_money','style'=>'margin-left:20px','class' => '']) ?></h6>
        </td>
    </tr>
</table>

</div>

<div>
<div class="title-wrapper">
    <div class="section-title">
        <h4 class="title">Profit Information</h4>
    </div>
    <span class="divider"></span>
    <div class="clear"></div>
</div>
<table class="items table">
    <tr>
        <td>
            <h6 class="title"><strong>Current balance</strong></h6>
        </td>
        <td>
            <h6>$<?php echo User::model()->getAmount() ?>
                <?php echo CHtml::link('Refill Account','#',[
                        'onclick'=>'
                            $.ajax({
                                url: "'.Yii::app()->createAbsoluteUrl("/private/ajax/refillTransaction").'",
                                type: "POST",
                                success: function(html){
                                    $("#modal").html(html);
                                    $.fancybox.open({type: "inline", href: "#modal"})
                                }
                            });
                            return false;
                        ',
                        'style'=>'margin-left:20px','class' => '']) ?>
            </h6>
        </td>
    </tr>
    <tr>
        <td>
            <h6 class="title"><strong>Total investment</strong></h6>
        </td>
        <td>
            <h6><?php  ?></h6>
        </td>
    </tr>
    <tr>
        <td>
            <h6 class="title"><strong>Profit from investments</strong></h6>
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
<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'.fancy-inline',
    'config'=>array(),
)); ?>
<div id="modal" style="display: none;"></div>

<div id="modalPerfectMoney" style="display: none;">
    <h4 class="title">Edit PM account</h4>
    <div class="form">
        <div>
            <?php echo CHtml::textField('pm_account', $user->perfect_purse, ['id'=>'pm_account']) ?><br/>
            <?php echo CHtml::button('Save', ['id'=>'savePM','style'=>'margin-left: 0px; margin-top:30px; margin-bottom;0px ','class'=>'submit_button']); ?>
        </div>
    </div>
</div>

<div id="modalPassword" style="display: none;">
    <h4 class="title">Edit Password</h4>
    <div class="form">
        <div>
            <div>enter the new password two times</div>
            <?php echo CHtml::passwordField('passwordOne', '', ['id'=>'passwordOne']) ?><br/>
            <?php echo CHtml::passwordField('passwordTwo', '', ['id'=>'passwordTwo']) ?><br/>
            <div id="alert_edit_password"></div>
            <?php echo CHtml::button('Save', ['id'=>'savePassword','style'=>'margin-left: 0px; margin-top:30px; margin-bottom;0px ','class'=>'submit_button']); ?>
        </div>
    </div>
</div>

<script>
    $("#edit_perfect_money").on("click", function() {
        $.fancybox.open({type: "inline", href: "#modalPerfectMoney"});
        return false;
    });

    $("#savePM").on("click", function() {
        $.ajax({
            url: "<?php echo Yii::app()->createAbsoluteUrl("/private/ajax/editPerfectMoneyAccount") ?>",
            data: {pm_account: $("#pm_account").val()},
            dataType: "json",
            type: "POST",
            success: function(data){
                $("#perfect").html(data.pm);
                $.fancybox.close({type: "inline", href: "#modalPerfectMoney"})
            }
        });
        return false;
    });

    $("#edit_password").on("click", function() {
        $.fancybox.open({type: "inline", href: "#modalPassword"});
        $("#alert_edit_password").empty();
    });

    $("#passwordOne").keydown(function(event){
        $("#alert_edit_password").empty();
    });

    $("#passwordTwo").keydown(function(event){
        $("#alert_edit_password").empty();
    });


    $("#savePassword").on("click", function(){
        var one = $("#passwordOne").val();
        var two = $("#passwordTwo").val();

        if ( one == '' && two == '' ){
            $("#alert_edit_password").html("Enter the password").attr('style','color:red;margin-bottom:15px');

        } else if  ( one == two ){
            $.ajax({
                url: "<?php echo Yii::app()->createAbsoluteUrl("/private/ajax/editPassword") ?>",
                data: {password: two},
                dataType: "json",
                type: "POST",
                success: function(data){
                    $.fancybox.close({type: "inline", href: "#modalPassword"})
                    $("#passwordOne").val('');
                   $("#passwordTwo").val('');
                }
            })
        } else {
            $("#alert_edit_password").html("The password fields do not match").attr('style','color:red;margin-bottom:15px');
        }
    });
</script>