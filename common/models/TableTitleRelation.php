<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "yp_title_relation".
 *
 * @property string $id
 * @property string $title_id 称号id
 * @property string $uid 用户id
 * @property int $status 状态，1开启，0关闭
 * @property string $expired_at 过期时间
 * @property string $created_at
 * @property string $updated_at
 */
class TitleRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yp_title_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_id', 'uid', 'status', 'expired_at', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_id' => 'Title ID',
            'uid' => 'Uid',
            'status' => 'Status',
            'expired_at' => 'Expired At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
