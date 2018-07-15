<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $preview
 * @property string $date_create
 * @property string $image_url
 * @property int $creator_id
 */
class News extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_create'], 'safe'],
            // [['creator_id'], 'required'],
            [['creator_id'], 'integer'],
            [['title', 'image_url'], 'string', 'max' => 255],
            [['preview'], 'string', 'max' => 1000],
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'preview' => 'Preview',
            'date_create' => 'Date Create',
            'image_url' => 'Image Url',
            'creator_id' => 'Creator ID',
        ];
    }

    public function uploadImage(){
        if (!$this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->image_url = Yii::getAlias('@app') . '/' . 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            return true;
        } else {
            return false;
        }

    }
}
