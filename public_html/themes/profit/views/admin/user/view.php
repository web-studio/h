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

<table>
    <tr>
        <td>ID</td>
        <td><?php echo $user->id; ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo User::getСropNameById($user->id); ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $user->email; ?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?php echo $user->country . '' . $user->city . '' . $user->street; ?></td>
    </tr>
    <tr>
        <td>Created time</td>
        <td><?php echo $user->createtime; ?></td>
    </tr>
    <tr>
        <td>Last visit</td>
        <td><?php echo $user->last_visit; ?></td>
    </tr>
    <tr>
        <td>Internal Purse</td>
        <td><?php echo $user->internal_purse; ?></td>
    </tr>
    <tr>
        <td>Perfect Purse</td>
        <td><?php echo $user->perfect_purse; ?></td>
    </tr>
</table>

