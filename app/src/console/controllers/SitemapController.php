<?php

namespace app\console\controllers;


use app\models\Task;
use spartaksun\sitemap\generator as generator;
use yii\base\ErrorException;
use yii\console\Controller;

class SitemapController extends Controller
{
    /**
     * @var generator\Generator
     */
    private $generator;


    /**
     * @param string $id
     * @param \yii\base\Module $module
     * @param generator\Generator $generator
     * @param array $config
     */
    public function __construct($id, $module, generator\Generator $generator, $config = [])
    {
        $this->generator = $generator;
        parent::__construct($id, $module, $config = []);
    }

    /**
     * Process one task
     * @param $id
     * @return bool|int
     */
    public function actionTask($id)
    {
        $task = Task::findOne($id);

        if(!$task) {
            return $this->stdout("Task {$id} not found \n");
        }

        $generator = $this->generator;

        $storage = $generator->storage;
        $storage->setKey($task->storage_key);

        $storage->on(generator\storage\UniqueValueStorageInterface::EVENT_ADD_URLS, function ($event) use ($task) {
            /* @var generator\Event $event */
            $params = $event->getParams();

            if (empty($params['amount'])) {
                throw new ErrorException('Invalid or not found amount');
            }

            $task->amount += $params['amount'];
            $task->status = Task::STATUS_IN_PROGRESS;
            $task->save();
        });

        $generator->siteProcessor->on(generator\SiteProcessor::EVENT_PROCESSED_ALL, function () use ($task) {
            $task->status = Task::STATUS_PARSED;
            $task->save();
        });

        $generator->writer->on(generator\writer\WriterInterface::EVENT_FINISH, function () use ($task) {
            $task->status = Task::STATUS_FINISHED;
            $task->save();
        });

        try{

            $generator->generate($task->start_url, $task->nesting_level, $task->realPath());

        } catch(generator\GeneratorException $e) {
            \Yii::error($e->getMessage());
        } catch(\Exception $e) {
            \Yii::error($e->getMessage());
        } finally {
            $storage->deInit();
        }

        return $this->stdout("OK\n");
    }
}