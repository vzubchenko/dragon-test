<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \frontend\models\ImageForm;
use kartik\file\FileInput;

/** @var ImageForm $model */

$this->title = 'Загрузка изображений';
?>

<?= Html::a('Назад', ['image/index'], ['class' => 'btn btn-primary']) ?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div id="file-inputs">
    <div class="file-input-container">
        <?= $form->field($model, 'images[]')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/png, image/jpeg, image/jpg, image/gif', 'multiple' => true],
            'pluginOptions' => [
                'language' => 'ru',
                'showCaption' => false,
                'showUpload' => true,
                'removeClass' => 'btn btn-danger',
                'removeIcon' => '<i class="fas fa-trash"></i> ',
                'uploadUrl' => Url::to(['/image/upload-image']),
                'maxFileSize'=> 5000,
                'maxFileCount' => 10
            ]
        ]); ?>
    </div>
</div>

<?php ActiveForm::end(); ?>