<?php
$this->pageTitle = 'My account';

$this->breadcrumbs=array(
	$this->module->id,
);
?>

<table class="items table">
    <tr>
        <td>
            <h4 class="title"><strong>Full name</strong></h4>
        </td>
        <td>
            <h4><?php echo $user->first_name .' '. $user->last_name ?></h4>
        </td>
    </tr>
    <tr>
        <td>
            <h4 class="title"><strong>Email</strong></h4>
        </td>
        <td>
            <h4><?php echo $user->email ?></h4>
        </td>
    </tr>
    <tr>
        <td>
            <h4 class="title"><strong>Internal purse</strong></h4>
        </td>
        <td>
            <h4><?php echo $user->internal_purse ?></h4>
        </td>
    </tr>
    <tr>
        <td>
            <h4 class="title"><strong>Perfect money account</strong></h4>
        </td>
        <td>
            <h4><?php echo $user->perfect_purse ?></h4>
        </td>
    </tr>
</table>






    <span class="hr"></span>

<?php echo CHtml::link('Edit personal data', '#') ?>