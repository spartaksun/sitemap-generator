<?php
/**
 * @var $this yii\web\View
 * @var app\models\Task|null $task
 */
$this->title = 'One task';
$this->params['breadcrumbs'][] = $task->start_url;
if ($task->status == \app\models\Task::STATUS_FINISHED) {
    $url = \yii\helpers\Html::a(\Yii::t('app', 'link'), ['index/download', 'id' => $task->id]);
} else {
    $url = null;
    $this->registerJs('setInterval(function(){location.reload();}, 5000);');
}
?>

<h1><?= $this->title ?></h1>

<div class="panel-body">


    <?= \yii\widgets\DetailView::widget([
        'model' => $task,
        'attributes' => [
            'start_url:url',
            'nesting_level',
            'amount',
            'status' => [
                'value' => $task->statusAsString(),
                'label' => \Yii::t('app', 'Status')
            ],
            [
                'label' => \Yii::t('app', 'Download'),
                'format' => 'raw',
                'value' => $url
            ]
        ],
    ]) ?>

</div>




