<?php
/**
 * @var  string $message
 * @var app\models\Task|null $task
 */

?>

<h1><?= "Index page" ?></h1>


<div class="panel-body">

    <?php if(!empty($message)):?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>

    <?php if (!is_null($task)): ?>

        <?= \yii\widgets\DetailView::widget([
            'model' => $task,
            'attributes' => [
                'start_url:url',
                'nesting_level',
                'amount',
                'status' => [
                    'value' => $task->status,
                    'label' => \Yii::t('app', 'Status')
                ],
            ],
        ]) ?>
    <?php else: ?>

        <?= \yii\helpers\Html::a('Generate new', \yii\helpers\Url::to('index/create')) ?>

    <?php endif; ?>

</div>




