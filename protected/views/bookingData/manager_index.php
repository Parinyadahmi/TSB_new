<?php if(Yii::app()->session['company_id'] !== null){ ?>
<?php
$this->breadcrumbs=array(
	'ข้อมูลการจอง',
);
?>
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#booking-data-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>ข้อมูลการจอง</h1>
<div>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php echo $form->textFieldRow($model, 'ID', array('class'=>'input-medium', 'prepend'=>'<i class="icon-search"></i>')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'ค้นหา')); ?>
<?php $this->endWidget(); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'booking-data-grid',
	'template'=>'{items}{pager}',
	'dataProvider'=>$model->searchForCompany(),
	'columns'=>array(
		array('name'=>'ID',
			'htmlOptions'=>array('style'=>'text-align:center')),
		array('name'=>'departure_date',
			'htmlOptions'=>array('style'=>'text-align:center')),
		array('name'=>'booking_date',
			'htmlOptions'=>array('style'=>'text-align:center')),
		array('name'=>'pay_stat',
			'htmlOptions'=>array('style'=>'text-align:center')),
		array('name'=>'staff_name',
			'htmlOptions'=>array('style'=>'text-align:center')),
		'link'=>array(
			'header'=>'ดูเพิ่มเติม',
			'type'=>'raw',
			'value'=> 'CHtml::button("รายละเอียด",
					   array("onclick"=>"document.location.href=\'".Yii::app()->controller->createUrl("bookingdata/managerview",
					   array("id"=>$data->ID))."\'"))',
			'htmlOptions'=>array('style'=>'text-align:center')),
	),
)); ?>
<?php }else{?>
<?php $this->breadcrumbs=array(
		'ข้อมูลการจอง',
);?>
<?php echo 'คุณไม่สามารถเข้าดูข้อมูลการจองได้ กรุณาสมัครสมาชิกในส่วนของผู้ประกอบการ'; ?>
<?php }?>