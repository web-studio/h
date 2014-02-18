
<div style="background-color: #f8f8f8; border: 1px solid #e3e2e2; margin: 0 20px 20px 20px;padding: 10px">


    <h5><?php echo CHtml::link(CHtml::encode($data->title),array('view','id'=>$data->id)); ?></h5>

	<br />

	<span><?php echo CHtml::encode($data->description); ?></span>

    <br />

	 <span style="position: absolute; right:370px;"><?php echo CHtml::encode($data->created_time); ?></span>
	<br />



</div>