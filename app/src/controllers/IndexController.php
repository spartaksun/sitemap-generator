<?php

namespace app\controllers;


use app\models\Task;
use spartaksun\sitemap\generator\Generator;
use yii\web\Controller;
use yii\web\Session;

class IndexController extends Controller
{
    /**
     * @var Generator
     */
    private $generator;


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
        $session = new Session();
        $session->open();


        echo "===". \Yii::getAlias('@app');
        $task = Task::findOne(['storage_key' => $session->id]);

        $message = 'Нет заданий';

        if ($task) {
            $message = 'Taска в процессе';
        }

        return $this->render('index', [
            'message' => $message
        ]);
    }

    public function actionCreate()
    {
        $task = new Task();
        $session = new Session();
        $session->open();

        if ($task->load(\Yii::$app->request->post())) {

            $task->storage_key = $session->id;
            if ($task->save()) {
                \Yii::$app->session->setFlash('success', 'Task successfully created');

                $cmd = \Yii::getAlias('@app') . "/console/yii sitemap/task " . $task->id;
                shell_exec(sprintf('nohup %s > %s 2>&1 & echo $!', $cmd, '/var/log/app/' . $session->id));

                return $this->redirect('/');
            }
        }

        return $this->render('create', [
            'task' => $task
        ]);
    }

}