<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wp_video}}".
 *
 * @property string $id
 * @property string $name
 * @property int $type 1-电影，2-电视剧，3-动漫，4-综艺
 * @property int $sub_type
 * @property string $date_str
 * @property string $url
 * @property string $created_at
 * @property string $last_update
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wp_video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date_str', 'url', 'created_at'], 'required'],
            [['type', 'sub_type', 'created_at', 'last_update'], 'integer'],
            [['url'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['date_str'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'sub_type' => 'Sub Type',
            'date_str' => 'Date Str',
            'url' => 'Url',
            'created_at' => 'Created At',
            'last_update' => 'Last Update',
        ];
    }
}
