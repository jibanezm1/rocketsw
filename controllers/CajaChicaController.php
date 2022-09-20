<?php

namespace app\controllers;

use Yii;
use app\models\CajaChica;
use app\models\CajaChicaSearch;
use app\models\GastosCajaChica;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Mpdf\Mpdf;
use app\models\GastosProyecto;
use yii\web\UploadedFile;
use app\models\GastosProyectoSearch;

/**
 * CajaChicaController implements the CRUD actions for CajaChica model.
 */
class CajaChicaController extends Controller
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
     * Lists all CajaChica models.
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
	    $session->open();
		$user_id = $session->get('usuario');
		
        $searchModel = new CajaChicaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if($user_id->rutUsuario==101010 || $user_id->rutUsuario==303030){
            
        }else{
        $dataProvider->query->where(['rutUsuario' => $user_id->rutUsuario]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
      public function actionCreate2()
    {
        $model = new GastosProyecto();

        if ($model->load(Yii::$app->request->post())) {


            $foto1 = UploadedFile::getInstances($model, 'fotoGasto');
            


            foreach ($foto1 as $file) {
                $password = rand(1,1000);

                $ext2 = explode(".", $file->name);
                $path =  Yii::$app->basePath  . '/web/gastos/' . $model->idProyecto ."-".$password. "-" . $file->name;

                if ($file->saveAs($path)) {
                    $model->fotoGasto = '/gastos/' . $model->idProyecto ."-".$password. "-" . $file->name;
                }
            }
            

            $model->save(false);
            
            if(Yii::$app->request->post()["cajachica"] == "on"){
                
                $valid = CajaChica::find()->where(["rutUsuario" => $model->rutUsuario])->andWhere(["estado" => 1])->one();
                
                if($valid)
                {
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
           
            return $this->redirect(['caja-chica/view', 'id' => $caja->idCajachica]);
        } else {
            $session = Yii::$app->session;
            $session->open();
            $user_id = $session->get('usuario');
            $model->rutUsuario = $user_id->rutUsuario;
        }


        return $this->render('create2', [
            'model' => $model,
        ]);
    }


    /**
     * Displays a single CajaChica model.
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
     * Creates a new CajaChica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CajaChica();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->saldo = $model->monto;
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->idCajachica]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
     public function actionExportar($id)
    {



        $mpdf = new Mpdf();

        $model = $this->findModel($id);
        $mpdf->WriteHTML($this->renderPartial('pdf', [
            'model' => $model,
        ]));
        $nombreArchivo = "Caja Chica Nº:" . $model->usuario->nombreUsuario . " Fecha:" . $model->fechaCreacion . ".pdf";

        $mpdf->Output($nombreArchivo, 'I');
        exit;
    }

    /**
     * Updates an existing CajaChica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idCajachica]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CajaChica model.
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
     * Finds the CajaChica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CajaChica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CajaChica::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
