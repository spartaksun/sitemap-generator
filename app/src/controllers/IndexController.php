<?php

namespace app\controllers;


use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex()
    {
        \Yii::$app->session->setFlash('error', 'Some error');

        return $this->render('index');
    }
}