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
            [['imageFile'], 'file', 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false],
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
        if ($this->validate() && isset($this->imageFile)) {
            $name = Yii::$app->security->generateRandomString(20) . '.' . $this->imageFile->extension;
            $path = Yii::getAlias('@backend') . '/web/uploads/' . $name;
            // print_r($path);exit;
            $this->imageFile->saveAs($path);
            // $this->save();
            $this->image_url = $name;
            return true;
        } else {
            return false;
        }

    }
}
