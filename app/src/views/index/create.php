<?php
/**
 * @var  \app\models\Task $task
 */
?>
<div class="panel-body">
    <h1>
        Generate map
    </h1>

    <?php $form = \yii\widgets\ActiveForm::begin(); ?>


    <?= $form->errorSummary($task); ?>

    <?= $form->field($task, 'start_url')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($task, 'nesting_level')->dropDownList([1=>1, 2=>2, 3=> 3, 4=>4, 5=> 5]) ?>

    <?= \yii\helpers\Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>

    <?php \yii\widgets\ActiveForm::end() ?>
</div>