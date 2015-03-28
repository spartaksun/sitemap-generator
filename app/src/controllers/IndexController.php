<?php

namespace app\controllers;


use spartaksun\sitemap\generator\Generator;
use yii\web\Controller;

class IndexController extends Controller
{

    /**
     * @var Generator
     */
    protected $generator;


    /**
     * @param string $id
     * @param \yii\base\Module $module
     * @param Generator $generator
     * @param array $config
     */
    public function __construct($id, $module, Generator $generator, $config = [])
    {
        $this->generator = $generator;
        parent::__construct($id, $module, $config = []);
    }

    public function actionIndex()
    {
        \Yii::$app->session->setFlash('success', 'All right =)');

        $generator = $this->generator;

        $generator->level = 1;
        $generator->storage->setKey('uuuuu');

        $generator->generate('http://en.wikipedia.com');

        return $this->render('index');
    }
}