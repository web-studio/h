<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$user->id,
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'Update User','url'=>array('update','id'=>$user->id)),
	array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$user->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User','url'=>array('admin')),
);
?>
<div class="password_message" style="display: none">
    <p class="note success">Password was been changed</p>
    <br>
</div>

<table class="items table">
    <tr>
        <td><h6 class="title"><strong>ID</strong></h6></td>
        <td><h6  class="user_id" id="<?php echo $user->id; ?>"><?php echo $user->id; ?></h6></td>
    </tr>
    <tr>
        <td><h6 class="title"><strong>Name</strong></h6></td>
        <td><h6><?php echo User::getСropNameById($user->id); ?></h6></td>
    </tr>
    <tr>
        <td><h6 class="title"><strong>Email</strong></h6></td>
        <td><h6><?php echo $user->email; ?></h6></td>
    </tr>
    <tr>
        <td><h6 class="title"><strong>Password</strong></h6></td>
        <td> <h6><?php echo CHtml::link('Edit','#',
                    ['id'=>'edit_password','style'=>'margin-left:20px','class' => '']) ?></h6></td>
    </tr>
    <tr>
        <td><h6 class="title"><strong>Address</strong></h6></td>
        <td><h6><?php echo $user->country . '' . $user->city . '' . $user->street; ?></h6></td>
    </tr>
    <tr>
        <td><h6 class="title"><strong>Created time</strong></h6></td>
        <td><h6><?php echo $user->createtime; ?></h6></td>
    </tr>
    <tr>
        <td><h6 class="title"><strong>Last visit</strong></h6></td>
        <td><h6><?php echo $user->last_visit; ?></h6></td>
    </tr>
    <tr>
        <td><h6 class="title"><strong>Internal Purse</strong></h6></td>
        <td><h6><?php echo $user->internal_purse; ?></h6></td>
    </tr>
    <tr>
        <td><h6 class="title"><strong>Perfect Purse</strong></h6></td>
        <td><h6><?php echo $user->perfect_purse; ?></h6></td>
    </tr>
    <tr>
        <td><h6 class="title"><strong>Current balance</strong></h6></td>
        <td><h6>$<?php echo User::model()->getAmount($user->id) ?></td>
    </tr>
</table>
<h6 class="title"><strong>Active deposits:</strong></h6>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'user-deposits-grid',
    'dataProvider'=>$deposits->depositSearchById($user->id),
    'template' => '{items}{pager}',
    'columns'=>array(
        [
            'name'=>'deposit_type_id',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'DepositType::model()->getNameById($data->deposit_type_id)'
        ],
        [
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
        ],
        [
            'name'=>'expire',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'User::formatDate($data->expire)'
        ],
        [
            'name'=>'status',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'UserDeposit::model()->getStatus($data->status)'
        ],
    ),
)); ?>
<h6 class="title"><strong>Output:</strong></h6>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'user-transfer-grid',
    'dataProvider'=>$output->outputSearchById($user->id),
    'template' => '{items}{pager}',
    'columns'=>array(
        'payment_batch_num',

        [
            'name'=>'created_time',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'User::formatDate($data->created_time,true)'
        ],

        [
            'name'=>'payment_amount',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'"$" . $data->payment_amount'
        ],
        [
            'name'=>'payee_account',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'$data->payee_account'
        ],
        [
            'name'=>'status',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'OutputTransactions::model()->getStatus($data->status)'
        ],

    ),
)); ?>
<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'.fancy-inline',
    'config'=>array(),
)); ?>
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
    $("#edit_password").on("click", function() {
        $.fancybox.open({type: "inline", href: "#modalPassword"});
        $("#alert_edit_password").empty();
        return false;
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
        var pasOne_length = one.replace(/\s+/g,'').length;
        var pasTwo_length = two.replace(/\s+/g,'').length;

        if ( pasOne_length < 6 && pasTwo_length < 6 ){
            $("#alert_edit_password").html("Password must be at least 6 characters or equal").attr('style','color:red;margin-bottom:15px');

        } else if  ( one == two ){
            $.ajax({
                url: "<?php echo Yii::app()->createAbsoluteUrl("/admin/user/editPasswordUsers") ?>",
                data: {user_id: $(".user_id").attr("id") ,password: two},
                dataType: "json",
                type: "POST",
                success: function(data){
                    $.fancybox.close({type: "inline", href: "#modalPassword"});
                    $(".password_message").show(200).delay(10000).hide(200);
                    $("#passwordOne").val('');
                    $("#passwordTwo").val('');
                }
            })
        } else {
            $("#alert_edit_password").html("The password fields do not match").attr('style','color:red;margin-bottom:15px');
        }
    });
</script>

