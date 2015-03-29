<?php

namespace app\controllers;


use app\models\Task;
use yii\web\Controller;
use yii\web\Session;
use spartaksun\sitemap\generator\Generator;

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

    /**
     * Index page
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $task = $this->getTask();

        return $this->render('index', [
            'message' => !empty($task) ? \Yii::t('app', 'In progress ...') : '',
            'task'  => $task,
        ]);
    }

    /**
     * Create new task
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if($this->getTask()) {
            return $this->redirect('/');
        }

        $task = new Task();
        $session = new Session();
        $session->open();

        if ($task->load(\Yii::$app->request->post())) {

            $task->storage_key = $session->id;
            if ($task->save()) {

                $logPath = \Yii::getAlias('@app') . '/runtime/'  . $task->id . '.log';
                $cmd = \Yii::getAlias('@app') . "/console/yii sitemap/task " . $task->id;

                shell_exec(
                    sprintf('nohup %s > %s 2>&1 & echo $!', $cmd, $logPath)
                );
                \Yii::$app->session->setFlash('success', 'Task successfully created');

                return $this->redirect('/');
            }
        }

        return $this->render('create', [
            'task' => $task
        ]);
    }

    /**
     * @return Task|null
     */
    public function getTask()
    {
        $session = new Session();
        $session->open();
        $task = Task::findOne(['storage_key' => $session->id]);

        return $task;
    }

}