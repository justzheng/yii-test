<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "study_lesson".
 *
 * @property string $id
 * @property int $car_type 考试车辆类型
 * @property int $subject_id 科目
 * @property int $type 课程type 1科目 2章节 3分类 4具体课程视频
 * @property int $lesson_id 原始课程id
 * @property int $parent_id 上级id
 * @property int $top_parent_id 课程最上级id
 * @property string $course_name 名称
 * @property string $video 视频编号
 * @property int $video_start 视频默认开始播放时间
 * @property double $duration 视频原始秒数
 * @property double $edit_duration 视频自定义秒数
 * @property int $sort 排序
 * @property string $play_url 跳转url
 * @property int $status 状态
 * @property int $updated_at
 */
class StudyLesson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'study_lesson';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_type', 'subject_id', 'type', 'lesson_id', 'parent_id', 'top_parent_id', 'video_start', 'sort', 'status', 'updated_at'], 'integer'],
            [['lesson_id'], 'required'],
            [['duration', 'edit_duration'], 'number'],
            [['course_name', 'video', 'play_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_type' => 'Car Type',
            'subject_id' => 'Subject ID',
            'type' => 'Type',
            'lesson_id' => 'Lesson ID',
            'parent_id' => 'Parent ID',
            'top_parent_id' => 'Top Parent ID',
            'course_name' => 'Course Name',
            'video' => 'Video',
            'video_start' => 'Video Start',
            'duration' => 'Duration',
            'edit_duration' => 'Edit Duration',
            'sort' => 'Sort',
            'play_url' => 'Play Url',
            'status' => 'Status',
            'updated_at' => 'Updated At',
        ];
    }
}
