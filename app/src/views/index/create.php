<?php
/**
 * @var $this yii\web\View
 * @var  \app\models\Task $task
 */
$this->title = 'Generate sitemap';
$this->params['breadcrumbs'][] = $this->title ;

?>
<div class="panel-body">
    <h1><?= $this->title ?></h1>

    <?php $form = \yii\widgets\ActiveForm::begin(); ?>


    <?= $form->errorSummary($task); ?>

    <?= $form->field($task, 'start_url')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($task, 'nesting_level')->dropDownList(array_combine(range(1, 10), range(1, 10))) ?>

    <?= \yii\helpers\Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>

    <?php \yii\widgets\ActiveForm::end() ?>
</div>