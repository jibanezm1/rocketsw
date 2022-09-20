<?php

namespace app\controllers;

use Yii;
use app\models\OrdenIngreso;
use app\models\Producto;
use app\models\OrdenIngresoSearch;
use app\models\DetalleOrdenIngreso;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use Mpdf\Mpdf;
use app\models\Modeloso;

/**
 * OrdenIngresoController implements the CRUD actions for OrdenIngreso model.
 */
class OrdenIngresoController extends Controller
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

    public function actionGenerar23($idordenIngreso, $rutProveedor){

        $mpdf = new Mpdf();
        $model = $this->findModel($idordenIngreso, $rutProveedor);
        $mpdf->WriteHTML($this->renderPartial('oc',[
            'model' => $model,
        ]));
        $nombreArchivo = "OC Nº:".$model->idordenIngreso." Cliente:".$model->rutProveedor0->nombreProveedor.".pdf";
        

        //return $this->render('oc');

       $mpdf->Output($nombreArchivo, 'I');
        exit;
        
    }

    /**
     * Lists all OrdenIngreso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdenIngresoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
     public function actionCorreo($idordenIngreso, $rutProveedor, $rutUsuario)
    {

        $model = $this->findModel($idordenIngreso, $rutProveedor);
        $lafecha = date('d/m/Y', strtotime($model->fechaIngreso));


        if ($model->proveedor->correoProveedor) {

            Yii::$app->mail->compose(['html' => '@app/templates/correoc.php'], ['model' => $model])
                ->setFrom('jibanez@apolotec.cl')
                ->setTo([$model->proveedor->correoProveedor])
                ->setCc([ 'juan.ibanez@outlook.com'])
                ->setSubject('Empresa OC Nº' . $model->idordenIngreso . ' de la fecha: ' . $lafecha . ' ')
                ->send();
            echo 1;
            exit;
        } 
        
    }

    /**
     * Displays a single OrdenIngreso model.
     * @param integer $idordenIngreso
     * @param integer $rutProveedor
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idordenIngreso, $rutProveedor)
    {
        return $this->render('view', [
            'model' => $this->findModel($idordenIngreso, $rutProveedor),
        ]);
    }

    /**
     * Creates a new OrdenIngreso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrdenIngreso();
        $modelsAddress = [new DetalleOrdenIngreso];
        //var_dump(Yii::$app->request->post());die();
        if ($model->load(Yii::$app->request->post())) {
            $model->fechaIngreso = date('Y-m-d');
            //var_dump($model);die();
            $model->save(false);

            $detalle = Yii::$app->request->post()["DetalleOrdenIngreso"];
            foreach($detalle as $item){
                $detallec = new DetalleOrdenIngreso();

                $detallec->idproducto = $item["idproducto"];

                $detallec->cantidad = $item["cantidad"];
                $detallec->precio = $item["precio"];
                $detallec->total = $item["total"];
                $detallec->iva = $item["iva"];
                $detallec->idordenIngreso = $model->idordenIngreso;
                $detallec->save(false);
                $producto = Producto::findOne($detallec->idproducto);
                $producto->stock = $producto->stock+$detallec->cantidad;
                $producto->save(false);
            }

            return $this->redirect(['view', 'idordenIngreso' => $model->idordenIngreso, 'rutProveedor' => $model->rutProveedor]);
        }else{

            if(isset($_GET['idProyecto'])) {
                $model->idProyecto = $_GET["idProyecto"];
            }else{
                $model->idProyecto = 1;
            }

            
            
        }

        return $this->render('create', [
            'model' => $model,
            'modelsAddress' => (empty($modelsAddress)) ? [new DetalleOrdenIngreso] : $modelsAddress
        ]);
    }

    /**
     * Updates an existing OrdenIngreso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idordenIngreso
     * @param integer $rutProveedor
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idordenIngreso, $rutProveedor)
    {
        $model = $this->findModel($idordenIngreso, $rutProveedor);
        $modelsAddress = $model->detalle;

        if ($model->load(Yii::$app->request->post())) {
            
            $oldIDs = ArrayHelper::map($modelsAddress, 'iddetalleordeningreso', 'iddetalleordeningreso');
            $modelsAddress = Modeloso::createMultiple3(DetalleOrdenIngreso::classname(), $modelsAddress);
            Modeloso::loadMultiple($modelsAddress, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAddress, 'iddetalleordeningreso', 'iddetalleordeningreso')));
            
            $valid = $model->validate();
            $valid = Modeloso::validateMultiple($modelsAddress) && $valid;
            if (!$valid) {

                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            DetalleOrdenIngreso::deleteAll(['iddetalleordeningreso' => $deletedIDs]);
                        }
                        foreach ($modelsAddress as $modelAddress) {

                            $modelAddress->idordenIngreso = $model->idordenIngreso;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'idordenIngreso' => $model->idordenIngreso, 'rutProveedor' => $model->rutProveedor]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
                
            return $this->redirect(['view', 'idordenIngreso' => $model->idordenIngreso, 'rutProveedor' => $model->rutProveedor]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelsAddress' => (empty($modelsAddress)) ? [new DetalleOrdenIngreso] : $modelsAddress,
        ]);
    }

    /**
     * Deletes an existing OrdenIngreso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idordenIngreso
     * @param integer $rutProveedor
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idordenIngreso, $rutProveedor)
    {
        $detalle = DetalleOrdenIngreso::find()->where(["idordenIngreso" => $idordenIngreso])->all();

        foreach($detalle as $d){
            try{
                $producto = Producto::findOne($d->idproducto);
                $producto->stock = $producto->stock-$d->cantidad;
                $producto->save(false);
                $d->delete();
            }catch(\Exception $exception){
                $d->delete();
            }
        }

        $this->findModel($idordenIngreso, $rutProveedor)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrdenIngreso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idordenIngreso
     * @param integer $rutProveedor
     * @return OrdenIngreso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idordenIngreso, $rutProveedor)
    {
        if (($model = OrdenIngreso::findOne(['idordenIngreso' => $idordenIngreso, 'rutProveedor' => $rutProveedor])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
