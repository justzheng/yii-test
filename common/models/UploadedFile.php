<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "uploaded_file".
 *
 * @property int $id
 * @property string $name
 * @property string $filename 文件附件
 * @property int $size
 * @property string $type
 */
class UploadedFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploaded_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filename'], 'string'],
            [['size'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['type'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'filename' => 'Filename',
            'size' => 'Size',
            'type' => 'Type',
        ];
    }
}
