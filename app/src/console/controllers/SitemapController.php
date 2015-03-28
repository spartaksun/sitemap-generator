<?php

namespace app\console\controllers;


use app\models\Task;
use spartaksun\sitemap\generator\Generator;
use yii\console\Controller;

class SitemapController extends Controller
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

    public function actionTask($id)
    {
        $task = Task::findOne($id);

        if(!$task) {
            return $this->stdout("Task {$id} not found \n");
        }

        $generator = $this->generator;
        $generator->level = $task->nesting_level;
        $generator->storage->setKey($task->storage_key);
        $generator->storage->onAdd(function($amount) use ($task) {
            $task->amount += $amount;
            $task->status = Task::STATUS_IN_PROGRESS;
            $task->save();
        });

        $generator->generate($task->start_url);

        return $this->stdout("Index OK\n");
    }
}