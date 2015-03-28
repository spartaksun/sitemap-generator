<?php
/**
 * @var  string $message
 */
?>

<h1><?= "Index page" ?></h1>


<div class="panel-body">

    <p><?= $message ?></p>
    <?= \yii\helpers\Html::a('Generate new', \yii\helpers\Url::to('index/create')) ?>

</div>




