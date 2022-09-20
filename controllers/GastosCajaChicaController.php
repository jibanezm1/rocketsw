<?php

namespace app\controllers;

use Yii;
use app\models\GastosCajaChica;
use app\models\CajaChica;


use app\models\GastosCajaChicaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\GastosProyecto;
use app\models\GastosProyectoSearch;

/**
 * GastosCajaChicaController implements the CRUD actions for GastosCajaChica model.
 */
class GastosCajaChicaController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all GastosCajaChica models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GastosCajaChicaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
  
    /**
     * Displays a single GastosCajaChica model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GastosCajaChica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate3()
    {
        $model = new GastosCajaChica();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_gastoCajaChica]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }
    
      public function actionCreate()
    {
        $model = new GastosCajaChica();

        if ($model->load(Yii::$app->request->post())) {


            $foto1 = UploadedFile::getInstances($model, 'documento');

            foreach ($foto1 as $file) {
                $password = rand(1,1000);

                $ext2 = explode(".", $file->name);
                $path =  Yii::$app->basePath  . '/web/cajaChica/' . $model->idCajachica ."-".$password. "-" . $file->name;

                if ($file->saveAs($path)) {
                    $model->documento = '/cajaChica/' . $model->idCajachica ."-".$password. "-" . $file->name;
                }
            }
            
            $caja = CajaChica::find()->where(['idCajachica' => $model->idCajachica])->one();
            $caja->saldo = $caja->saldo - $model->monto;
            $caja->save(false);
            $model->save(false);
           
            return $this->redirect(['caja-chica/view', 'id' => $model->idCajachica]);
        } else {
            $model->idCajachica =  $_GET["idCajachica"];
            
        }


        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GastosCajaChica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_gastoCajaChica]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GastosCajaChica model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GastosCajaChica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GastosCajaChica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GastosCajaChica::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
