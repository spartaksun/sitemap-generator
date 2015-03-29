<?php

namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Task
 * @property string $storage_key
 * @property string $start_url
 * @property int $nesting_level
 * @property int $created_at
 * @property int $updated_at
 * @property int $amount
 * @property int $status
 *
 * @package app\models
 */
class Task extends ActiveRecord
{

    const STATUS_NEW = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_FINISHED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['storage_key', 'start_url', 'nesting_level'], 'required'],
            [['storage_key'], 'unique'],
            [['storage_key'], 'string', 'max' => 32],
            [['start_url'], 'url'],
            [['start_url'], 'string', 'max' => 255],
            [['status', 'amount'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            ['nesting_level', 'integer', 'min' => 1, 'max' => 1000 ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'start_url' => 'URL',
            'nesting_level' => \Yii::t('app', 'Level'),
            'status' => \Yii::t('app', 'Status'),
            'amount' => \Yii::t('app', 'Pages'),
        ];
    }

}