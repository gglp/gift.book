<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ActBook;
use frontend\models\ActBookSearch;
use frontend\models\Book;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use conquer\select2\Select2Action;
use yii\db\ActiveQuery;

/**
 * ActbookController implements the CRUD actions for ActBook model.
 */
class ActbookController extends Controller
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

    public function actions()
    {
        return [
            'ajax' => [
                'class' => Select2Action::className(),
                'dataCallback' => [$this, 'dataCallback'],
            ],
        ];
    }
    /**
     * 
     * @param string $q
     * @return array
     */
    public function dataCallback($q, $act_id = null)
    {
/*        $query = new ActiveQuery(ActBook::className());
        $excludeIds = $query->select('book_id')
            ->filterWhere(['act_id' => $act_id])
            ->asArray()
            ->column();
*/
        $query = new ActiveQuery(Book::className());
        return [
            'results' =>  $query->select([
                    'id AS id',
                    'title AS text', 
                ])
                ->filterWhere(['like', 'title', $q])
//                ->andFilterWhere(['not in', 'id', $excludeIds])
                ->asArray()
                ->limit(10)
                ->all(),
        ];
    }

    /**
     * Lists all ActBook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActBookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActBook model.
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
     * Creates a new ActBook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($act_id = null)
    {
        $model = new ActBook();
        $model->act_id = $act_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['act/view', 'id' => $model->act_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ActBook model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['act/view', 'id' => $model->act_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ActBook model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['act/view', 'id' => $model->act_id]);
    }

    /**
     * Finds the ActBook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActBook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActBook::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
