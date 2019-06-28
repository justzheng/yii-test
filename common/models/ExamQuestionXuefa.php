<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exam_question_xuefa".
 *
 * @property int $id
 * @property int $category_id
 * @property int $type 1:单选;2判断;3多选
 * @property string $question 考试题目
 * @property string $image 考试题图片
 * @property string $option1 选项
 * @property string $option2
 * @property string $option3
 * @property string $option4
 * @property int $answer_num 答案个数
 * @property string $answer 答案
 * @property string $explain 解释
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class ExamQuestionXuefa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exam_question_xuefa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'type', 'question', 'option1', 'option2', 'answer'], 'required'],
            [['category_id', 'type', 'answer_num', 'created_at', 'updated_at', 'status'], 'integer'],
            [['explain'], 'string'],
            [['question'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 256],
            [['option1', 'option2', 'option3', 'option4'], 'string', 'max' => 100],
            [['answer'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'type' => 'Type',
            'question' => 'Question',
            'image' => 'Image',
            'option1' => 'Option1',
            'option2' => 'Option2',
            'option3' => 'Option3',
            'option4' => 'Option4',
            'answer_num' => 'Answer Num',
            'answer' => 'Answer',
            'explain' => 'Explain',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}
