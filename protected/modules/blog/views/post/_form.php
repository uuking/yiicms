<?php
/**
 * @var $form TBActiveForm
 * @var $this Controller
 * @var $model Post
 */
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id'                     => 'post-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'type'                   => 'vertical',
        'htmlOptions'            => array('class' => 'well'),
        'inlineErrors'           => true,
    )
); ?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->dropDownListRow(
    $model,
    'blog_id',
    CHtml::listData(Blog::model()->findAll(), 'id', 'title'),
    array('empty' => Yii::t('BlogModule.blog', 'select blog'), 'class' => 'span5')
); ?>
<?php echo $form->labelEx($model, 'publish_time'); ?>
<?php $this->widget(
    'ext.jui.EJuiDateTimePicker',
    array(
        'model'     => $model,
        'attribute' => 'publish_time',
        'options'   => array(
            'dateFormat' => 'yy-mm-dd',
        ),
    )
); ?>
<?php echo $form->error($model, 'publish_time'); ?>
<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 200)); ?>
<?php echo $form->textFieldRow($model, 'slug', array('class' => 'span5', 'maxlength' => 200)); ?>
<?php $this->widget(
    'ext.tinymce.TinyMce',
    array(
        'model'     => $model,
        'attribute' => 'content',
        'settings'  => array(
            'content_css' => Yii::app()->assetManager->getPublishedUrl(
                Yii::getPathOfAlias('ext.bootstrap.assets')
            ) . '/css/bootstrap.min.css'
        )
    )
); ?>
<?php echo $form->labelEx($model, 'tags'); ?>
<?php $this->widget(
    'application.components.widgets.AutoComplete',
    array(
        'name'        => 'tags',
        'value'       => implode(', ', $model->getTags()),
        'sourceUrl'   => array('AutoCompleteSearch'),
        'multiple'    => true,
        'htmlOptions' => array('class' => 'span5')
    )
);
?>
<?php echo $form->textFieldRow($model, 'keywords', array('class' => 'span5', 'maxlength' => 200)); ?>
<?php echo $form->textAreaRow($model, 'description', array('class' => 'span5')); ?>
<?php echo $form->textFieldRow($model, 'link', array('class' => 'span5', 'maxlength' => 200)); ?>
<?php echo $form->dropDownListRow($model, 'status', $model->statusMain->getList()); ?>
<?php echo $form->checkBoxRow($model, 'comment_status'); ?>
<?php echo $form->dropDownListRow($model, 'access_type', $model->statusAccess->getList()); ?>
<div class="form-actions">
    <?php $this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'buttonType' => 'submit',
        'type'       => 'primary',
        'label'      => $model->isNewRecord ? Yii::t('BlogModule.blog', 'Create') : Yii::t('BlogModule.blog', 'Save'),
    )
); ?>
</div>

<?php $this->endWidget(); ?>
