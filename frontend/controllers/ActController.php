<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Act;
use frontend\models\ActSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActController implements the CRUD actions for Act model.
 */
class ActController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Act models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Act model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Act model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Act();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Act model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Act model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Act model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Act the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Act::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPrintact($id)
    {
        Yii::$app->response->format = 'pdf';

        // Rotate the page
        Yii::$container->set(Yii::$app->response->formatters['pdf']['class'], [
            'marginLeft' => 30, // Optional
            'marginRight' => 10, // Optional
            'marginTop' => 15, // Optional
            'marginBottom' => 10, // Optional
            'marginHeader' => 0, // Optional
            'marginFooter' => 0, // Optional
            'format' => [210, 297], // Legal page size in mm
            'orientation' => 'Portrait', // This value will be used when 'format' is an array only. Skipped when 'format' is empty or is a string
        ]);

//        $this->layout = '//print';
        return $this->renderPartial('printact', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionPrintcards($id)
    {
        Yii::$app->response->format = 'pdf';

        // Rotate the page
        Yii::$container->set(Yii::$app->response->formatters['pdf']['class'], [
            'marginLeft' => 10, // Optional
            'marginRight' => 10, // Optional
            'marginTop' => 10, // Optional
            'marginBottom' => 10, // Optional
            'marginHeader' => 0, // Optional
            'marginFooter' => 0, // Optional
            'format' => [76, 126], // Legal page size in mm
            'orientation' => 'Landscape', // This value will be used when 'format' is an array only. Skipped when 'format' is empty or is a string
        ]);

        return $this->renderPartial('printcards', [
            'model' => $this->findModel($id),
        ]);
    }

}
