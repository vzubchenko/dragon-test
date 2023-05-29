<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class Image extends ActiveRecord
{
    public static function tableName(): string {
        return '{{image}}';
    }

}