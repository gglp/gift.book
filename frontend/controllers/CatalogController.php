<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Catalog;
use frontend\models\CatalogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\CatalogDateRangeForm;
use yii\db\Query;
use kartik\mpdf\Pdf;

/**
 * CatalogController implements the CRUD actions for Catalog model.
 */
class CatalogController extends Controller
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
                    'report' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Catalog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CatalogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Catalog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $dateRangeModel = new CatalogDateRangeForm();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dateRangeModel' => $dateRangeModel,
        ]);
    }

    /**
     * Creates a new Catalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Catalog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Catalog model.
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
     * Deletes an existing Catalog model.
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
     * Report about some category books
     * 
     * @param integer $id
     * @return mixed
     */
    public function actionReport($id)
    {
        $model = $this->findModel($id);
        
        $dateRangeModel = new CatalogDateRangeForm();
        
        if ($dateRangeModel->load(Yii::$app->request->post()) && $dateRangeModel->validate()) {
            $query = new Query();
            $query->select( [
                'restitle' => 'b.title',
                'resauthor' => 'b.author',
                'resinvnum' => new \yii\db\Expression('ANY_VALUE([[ab]].[[inventory_number]])'),
                'resactnumber' => new \yii\db\Expression('ANY_VALUE([[a]].[[number]])'),
                'resactdate' => new \yii\db\Expression('ANY_VALUE([[a]].[[date]])'),
                'resbookid' => 'ab.book_id',
                'resprice' => new \yii\db\Expression('SUM([[ab]].[[price]])'),
                'resbookcount' => new \yii\db\Expression('COUNT([[ab]].[[book_id]])'),                
            ])
            ->from('{{%act_book}} ab, {{%act}} a, {{%book}} b, {{%book_catalog}} bc ')
            ->where('[[ab]].[[act_id]] = [[a]].[[id]]')
            ->andWhere(['between', 'a.date', $dateRangeModel->from, $dateRangeModel->to])
            ->andWhere('[[ab]].[[book_id]] = [[b]].[[id]]')
            ->andWhere('[[b]].[[id]] = [[bc]].[[book_id]]')        
            ->andWhere(['=', 'bc.catalog_id', $id])
            ->groupBy('[[ab]].[[book_id]]');
            
            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
            $headers = Yii::$app->response->headers;
            $headers->add('Content-Type', 'application/pdf');
            
            $content = $this->renderPartial('printcatalogact', [
                'model' => $model,
                'dateRangeModel' => $dateRangeModel,
                'allModels' => $query->all(),
            ]);
            
            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, 
                'format' => Pdf::FORMAT_A4, 
                'orientation' => Pdf::ORIENT_PORTRAIT, 
                'destination' => Pdf::DEST_BROWSER, 
                'marginLeft' => 30,
                'marginRight' => 10,
                'marginTop' => 15,
                'marginBottom' => 10,
                'marginHeader' => 0,
                'marginFooter' => 10,
                'content' => $content,  
                'options' => [],
                'methods' => []
            ]);

            return $pdf->render();
        
        }
        
        return $this->redirect(['view', 'id' => $model->id]);
        

    }    

    /**
     * Finds the Catalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Catalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Catalog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
