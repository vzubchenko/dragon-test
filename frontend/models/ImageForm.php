<?php

namespace frontend\models;

use yii\base\Model;
    use yii\web\UploadedFile;

class ImageForm extends Model
{
    /**
    * @var UploadedFile[]
    */
    public $images;

    public function rules()
    {
        return [
            [['images'], 'file', 'maxFiles' => 10, 'extensions' => 'png, jpg, jpeg, gif'],
            [['images'], 'file', 'maxSize' => 5 * 1024 * 1024, 'skipOnEmpty' => false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'images' => 'Изображение',
        ];
    }
}

