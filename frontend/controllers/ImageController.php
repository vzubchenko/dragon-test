<?php

namespace frontend\controllers;

use yii\web\UploadedFile;
use frontend\models\ImageForm;
use frontend\models\Image;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class ImageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Image::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpload()
    {
        $model = new ImageForm();

        return $this->render('upload', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Image::findOne($id);

        if ($model){
            if (file_exists($model->path)) {
                unlink($model->path);
            }
            $model->delete();
        }

        return $this->redirect('/');
    }

    public function actionDownload($id)
    {
        $model = Image::findOne($id);

        if ($model) {
            if (file_exists($model->path)) {
                return Yii::$app->response->sendFile($model->path, basename($model->path));
            }
        }

        // Обработка случая, когда файл не найден или модель не существует
        throw new NotFoundHttpException('Файл не найден.');
    }

    public function actionUploadImage()
    {
        $model = new ImageForm();

        if (Yii::$app->request->isPost) {
            $model->images = UploadedFile::getInstances($model, 'images');

            foreach ($model->images as $image) {
                //создаем переменные для структуры папок
                $year = \yii\helpers\Html::encode(date('Y'));
                $month = \yii\helpers\Html::encode(date('m'));
                $day = \yii\helpers\Html::encode(date('d'));
                $directory = 'uploads/'.$year.'/'.$month.'/'.$day;

                //наполняем модель картинки
                $imageModel = new Image();
                $imageModel->created_at = \yii\helpers\Html::encode(date('Y-m-d H:i:s'));
                $imageModel->size = $image->size;

                //сохраняем файл, получаем его айди
                if ($imageModel->save(false)) {
                    $lastId = $imageModel->primaryKey;

                    $path = $directory.'/'.$lastId .'.' . $image->extension;
                    $imageModel->path = $path;

                    //обновляем путь файла в базе
                    $imageModel->save(false);

                    //убедимся что папка для файла есть, если нет - создаем
                    if (!is_dir($directory)) {
                        mkdir($directory, 0755, true);
                    }

                    // Сохранение файла на сервере
                    $image->saveAs($path);
                } else {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

}
