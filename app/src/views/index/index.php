<?php
/**
 * @var $this yii\web\View
 * @var  string $message
 * @var \yii\data\ActiveDataProvider $dataProvider
 */
$this->title = Yii::t('app', 'index');
$this->params['breadcrumbs'][] = '';
?>


<h1><?= $this->title ?></h1>


<div class="panel-body">
    <p>
        <?= \yii\helpers\Html::a('Generate', \yii\helpers\Url::to('index/create'), ['class' => 'btn btn-success']) ?>
    </p>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => \yii\grid\DataColumn::class,
                'attribute' => 'start_url',
                'format' => 'raw',
                'value' => function(\app\models\Task $task) {
                    return \yii\helpers\Html::a($task->start_url, ['index/view', 'id' => $task->id]);
                }
            ],
            'nesting_level',
            'amount',
            'status' => [
                'value' => function (\app\models\Task $task) {
                    return $task->statusAsString();
                },
                'label' => \Yii::t('app', 'Status')
            ],
            [
                'class' => \yii\grid\DataColumn::class,
                'format' => 'raw',
                'label' => \Yii::t('app', 'Download'),
                'value' => function(\app\models\Task $task) {
                    if($task->status == \app\models\Task::STATUS_FINISHED) {
                        return \yii\helpers\Html::a(\Yii::t('app', 'Download'), ['index/download', 'id' => $task->id]);
                    }

                    return null;
                }
            ],
        ],

    ]); ?>
</div>




