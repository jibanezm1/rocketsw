<?php

namespace app\controllers;

use Yii;
use app\models\GastosProyecto;
use app\models\GastosCajaChica;
use app\models\CajaChica;
use app\models\GastosProyectoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GastosProyectoController implements the CRUD actions for GastosProyecto model.
 */
class GastosProyectoController extends Controller
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
     * Lists all GastosProyecto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GastosProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GastosProyecto model.
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
     * Creates a new GastosProyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GastosProyecto();

        if ($model->load(Yii::$app->request->post())) {


            $foto1 = UploadedFile::getInstances($model, 'fotoGasto');



            foreach ($foto1 as $file) {
                $password = rand(1, 1000);

                $ext2 = explode(".", $file->name);
                $path =  Yii::$app->basePath  . '/web/gastos/' . $model->idProyecto . "-" . $password . "-" . $file->name;

                if ($file->saveAs($path)) {
                    $model->fotoGasto = '/gastos/' . $model->idProyecto . "-" . $password . "-" . $file->name;
                }
            }


            $model->save(false);

            if (array_key_exists("cajachica", Yii::$app->request->post())) {
                
                $valid = CajaChica::find()->where(["rutUsuario" => $model->rutUsuario])->andWhere(["estado" => 1])->one();

                if ($valid) {
                    $caja = new GastosCajaChica();


                    $caja->idCajachica = $valid->idCajachica;
                    $caja->documento =   $model->fotoGasto;
                    $caja->monto = $model->monto;
                    $caja->fechaGasto = $model->fechaGasto;
                    $caja->motivo = $model->motivoGasto;
                    $caja->idProyecto = $model->idProyecto;
                    $caja->idGasto = $model->idGastos;
                    $caja->save(false);
                    $valid->saldo = $valid->saldo - $caja->monto;
                    $valid->save(false);
                }
            }

            return $this->redirect(['proyectos/view', 'id' => $model->idProyecto]);
        } else {
            $model->idProyecto =  $_GET["idProyecto"];
            $session = Yii::$app->session;
            $session->open();
            $user_id = $session->get('usuario');
            $model->rutUsuario = $user_id->rutUsuario;
        }


        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing GastosProyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idGastos]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GastosProyecto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();
        return $this->redirect(['proyectos/view', 'id' => $model->idProyecto]);
    }

    /**
     * Finds the GastosProyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GastosProyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GastosProyecto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
