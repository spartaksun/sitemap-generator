<?php

namespace app\controllers;


use app\models\Task;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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
        $query = Task::find()->addOrderBy(['id' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);

        return $this->render('index', [
            'dataProvider'  => $dataProvider,
        ]);
    }

    /**
     * Displays one task
     *
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $task = Task::findOne($id);
        if(!$task) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', [
            'task'  => $task,
        ]);
    }

    /**
     * Create new task
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $task = new Task();

        if ($task->load(\Yii::$app->request->post())) {

            $task->storage_key = md5(microtime(true) . rand(1, 99999));
            if ($task->save()) {

                $logPath = \Yii::getAlias('@app') . '/runtime/'  . $task->id . '.log';
                $cmd = \Yii::getAlias('@app') . "/console/yii sitemap/task " . $task->id;

                shell_exec(
                    sprintf('nohup %s > %s 2>&1 & echo $!', $cmd, $logPath)
                );
                \Yii::$app->session->setFlash('success', 'Task successfully created');

                return $this->redirect(['index/view', 'id' => $task->id]);
            }
        }

        return $this->render('create', [
            'task' => $task
        ]);
    }

    /**
     * Zip archive with sitemap
     *
     * @param $id
     * @throws NotFoundHttpException
     * @throws \yii\base\ExitException
     */
    public function actionDownload($id)
    {
        $task = Task::findOne($id);
        if(!$task) {
            throw new NotFoundHttpException;
        }

        $filename = $task->realPath();
        if (!is_file($filename)) {
            throw new NotFoundHttpException;
        }

        $response = \Yii::$app->response;
        $response->sendFile($filename);

        \Yii::$app->end();
    }

}