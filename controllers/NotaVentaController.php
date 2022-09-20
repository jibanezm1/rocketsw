<?php

namespace app\controllers;

use Yii;
use app\models\NotaVenta;
use app\models\Producto;
use app\models\Proyectos;

use app\models\DetalleNota;
use app\models\Cliente;
use app\models\Cotizacion;
use yii\helpers\ArrayHelper;
use app\models\Modeloso;

use app\models\NotaVentaSearch;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotaVentaController implements the CRUD actions for NotaVenta model.
 */
class NotaVentaController extends Controller
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
     * Lists all NotaVenta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotaVentaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NotaVenta model.
     * @param integer $idNotaVenta
     * @param integer $rutCliente
     * @param integer $rutUsuario
     * @param integer $idempresa
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idNotaVenta)
    {
        return $this->render('view', [
            'model' => $this->findModel($idNotaVenta),
        ]);
    }

    /**
     * Creates a new NotaVenta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        SiteController::valid();
        $model = new NotaVenta();
        $cliente = new Cliente();
        $modelsAddress = [new DetalleNota];

        if ($model->load(Yii::$app->request->post())) {

            $cliente->load(Yii::$app->request->post());
            $valid = Cliente::findOne($cliente->rutCliente);

            if($valid){

            }else{
                $nuevocliente = new Cliente();

                $nuevocliente->load(Yii::$app->request->post());
                
                $nuevocliente->save(false);
            }
            //rutUsuario
            $session = Yii::$app->session;
            $session->open();
            $user_id = $session->get('usuario');
            $model->rutUsuario = $user_id->rutUsuario;
            $model->fecha = date('Y-m-d');;
            $model->estado = 1;
            $model->idempresa = 1;
            $model->rutCliente = $cliente->rutCliente;
            $model->save(false);
            $detalle = Yii::$app->request->post()["DetalleNota"];
            foreach($detalle as $item){
                $detallec = new DetalleNota();

                $detallec->idproducto = $item["idproducto"];
                $detallec->cantidad = $item["cantidad"];
                $detallec->precio = $item["precio"];
                $detallec->total = $item["total"];
                $detallec->tiempo = $item["tiempo"];
                $detallec->iva = $item["iva"];
                $detallec->idNota = $model->idNotaVenta;
                $detallec->save(false);
                $producto = Producto::findOne($detallec->idproducto);
                $producto->stock = $producto->stock-$detallec->cantidad;
                $producto->save(false);


            }

            
            return $this->redirect(['view', 'idNotaVenta' => $model->idNotaVenta, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa]);
        }
         else {
             
             if(isset($_GET["id"])){
            $proyecto = Proyectos::find()->where(['idProyecto' =>$_GET["id"] ])->one();

            $cliente = Cliente::find()->where([
                'rutCliente' => $proyecto->rutCliente
            ])->one();
            $model->idProyecto = $_GET["id"];
            $model->evento = $proyecto->nombreProyecto; 
             }
             

    
            
        }
        return $this->render('create', [
            'model' => $model,
            'cliente' => $cliente,
            'modelsAddress' => (empty($modelsAddress)) ? [new DetalleNota] : $modelsAddress
        ]);
    }

    /**
     * Updates an existing NotaVenta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idNotaVenta
     * @param integer $rutCliente
     * @param integer $rutUsuario
     * @param integer $idempresa
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idNotaVenta, $rutCliente, $rutUsuario, $idempresa)
    {
        SiteController::valid();
        $modelCustomer = $this->findModel($idNotaVenta, $rutCliente, $rutUsuario, $idempresa);
        $modelsAddress = $modelCustomer->detalle;


        if ($modelCustomer->load(Yii::$app->request->post())) {
            


            $oldIDs = ArrayHelper::map($modelsAddress, 'iddetalleNota', 'iddetalleNota');
            $modelsAddress = Modeloso::createMultiple1(DetalleNota::classname(), $modelsAddress);
            Modeloso::loadMultiple($modelsAddress, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAddress, 'iddetalleNota', 'iddetalleNota')));

          

            $valid = $modelCustomer->validate();
            $valid = Modeloso::validateMultiple($modelsAddress) && $valid;
            //var_dump($valid);die();
            if (!$valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelCustomer->save(false)) {
                        if (! empty($deletedIDs)) {
                            DetalleNota::deleteAll(['iddetalleNota' => $deletedIDs]);
                        }
                        foreach ($modelsAddress as $modelAddress) {
                            $modelAddress->idNota = $modelCustomer->idNotaVenta;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'idNotaVenta' => $modelCustomer->idNotaVenta, 'rutCliente' => $modelCustomer->rutCliente, 'rutUsuario' => $modelCustomer->rutUsuario, 'idempresa' => $modelCustomer->idempresa]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            return $this->redirect(['view', 'idNotaVenta' => $modelCustomer->idNotaVenta, 'rutCliente' => $modelCustomer->rutCliente, 'rutUsuario' => $modelCustomer->rutUsuario, 'idempresa' => $modelCustomer->idempresa]);
        }

        return $this->render('update', [
            'model' => $modelCustomer,
            'modelsAddress' => (empty($modelsAddress)) ? [new DetalleNota] : $modelsAddress,
            'cliente' => Cliente::findOne($modelCustomer->rutCliente)
        ]);
    }

    /**
     * Deletes an existing NotaVenta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idNotaVenta
     * @param integer $rutCliente
     * @param integer $rutUsuario
     * @param integer $idempresa
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idNotaVenta, $rutCliente, $rutUsuario, $idempresa)
    {

        SiteController::valid();
        $detalle = DetalleNota::find()->where(["idNota" => $idNotaVenta])->all();

        foreach($detalle as $d){
            try{
                $producto = Producto::findOne($d->idproducto);
                $producto->stock = $producto->stock+ $d->cantidad;
                $producto->save(false);
                $d->delete();
            }catch(\Exception $exception){
                $d->delete();
            }
        }
        $this->findModel($idNotaVenta, $rutCliente, $rutUsuario, $idempresa)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NotaVenta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idNotaVenta
     * @param integer $rutCliente
     * @param integer $rutUsuario
     * @param integer $idempresa
     * @return NotaVenta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idNotaVenta)
    {
        if (($model = NotaVenta::findOne(['idNotaVenta' => $idNotaVenta])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
