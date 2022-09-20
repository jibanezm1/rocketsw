<?php

namespace app\controllers;

use Yii;
use app\models\Cotizacion;
use app\controllers\SiteController;
use app\models\NotaVenta;
use app\models\DetalleNota;
use app\models\Proyectos;

use app\models\Producto;
use app\models\OrdenIngreso;
use app\models\ContactoCliente;

use app\models\Cliente;
use app\models\Modeloso;
use app\models\DetalleCotizacion;
use app\models\CotizacionSearch;
use app\models\GastosProyecto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;
use yii\db\Query;

/**
 * CotizacionController implements the CRUD actions for Cotizacion model.
 */
class CotizacionController extends Controller
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
     * Lists all Cotizacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        SiteController::valid();
        $searchModel = new CotizacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cotizacion model.
     * @param integer $idcotizacion
     * @param integer $rutCliente
     * @param integer $rutUsuario
     * @param integer $idempresa
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idcotizacion, $rutCliente, $rutUsuario, $idempresa)
    {
        SiteController::valid();
        return $this->render('view', [
            'model' => $this->findModel($idcotizacion, $rutCliente, $rutUsuario, $idempresa),
        ]);
    }

    /**
     * Creates a new Cotizacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        SiteController::valid();
        $model = new Cotizacion();
        $cliente = new Cliente();
        $modelsAddress = [new DetalleCotizacion];

        if ($model->load(Yii::$app->request->post())) {

            $cliente->load(Yii::$app->request->post());
            $valid = Cliente::findOne($cliente->rutCliente);

            if ($valid) {
            } else {
                $nuevocliente = new Cliente();

                $nuevocliente->load(Yii::$app->request->post());

                $nuevocliente->save(false);
            }
            //rutUsuario
            $session = Yii::$app->session;
            $session->open();
            $user_id = $session->get('usuario');
            $model->rutUsuario = $user_id->rutUsuario;
            $model->fecha = date('Y-m-d');
            $model->estado = 1;
            $model->idempresa = 1;
            $model->rutCliente = $cliente->rutCliente;
            $model->save(false);
            $detalle = Yii::$app->request->post()["DetalleCotizacion"];
            foreach ($detalle as $item) {
                $detallec = new DetalleCotizacion();
                $s = str_replace('.', '', $item["precio"]);
                $t = str_replace('.', '', $item["total"]);

                $detallec->idproducto = $item["idproducto"];
                $detallec->cantidad = $item["cantidad"];
                $detallec->precio = $s;
                $detallec->total = $t;
                $detallec->tiempo = $item["tiempo"];
                $detallec->iva = $item["iva"];
                $detallec->idcotizacion = $model->idcotizacion;
                $detallec->save(false);
            }


            return $this->redirect(['view', 'idcotizacion' => $model->idcotizacion, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa]);
        }

        return $this->render('create', [
            'model' => $model,
            'cliente' => $cliente,
            'modelsAddress' => (empty($modelsAddress)) ? [new DetalleCotizacion] : $modelsAddress
        ]);
    }



    public function actionCreater()
    {
        SiteController::valid();
        $model = new Cotizacion();
        $cliente = new Cliente();
        $modelsAddress = [new DetalleCotizacion];

        if ($model->load(Yii::$app->request->post())) {

            $cliente->load(Yii::$app->request->post());
            $valid = Cliente::findOne($cliente->rutCliente);

            if ($valid) {
            } else {
                $nuevocliente = new Cliente();

                $nuevocliente->load(Yii::$app->request->post());

                $nuevocliente->save(false);
            }
            //rutUsuario
            $session = Yii::$app->session;
            $session->open();
            $user_id = $session->get('usuario');
            $model->rutUsuario = $user_id->rutUsuario;
            $model->fecha = date('Y-m-d');
            $model->estado = 1;
            $model->idempresa = 1;
            $model->rutCliente = $cliente->rutCliente;
            $model->save(false);
            $detalle = Yii::$app->request->post()["DetalleCotizacion"];
            foreach ($detalle as $item) {
                $detallec = new DetalleCotizacion();
                $s = str_replace('.', '', $item["precio"]);
                $t = str_replace('.', '', $item["total"]);

                $detallec->idproducto = $item["idproducto"];
                $detallec->cantidad = $item["cantidad"];
                $detallec->precio = $s;
                $detallec->total = $t;
                $detallec->tiempo = $item["tiempo"];
                $detallec->iva = $item["iva"];
                $detallec->idcotizacion = $model->idcotizacion;
                $detallec->save(false);
            }


            return $this->redirect(['view', 'idcotizacion' => $model->idcotizacion, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa]);
        } else {


            $elcliente = Cliente::find()->where([
                'rutCliente' => $_GET["rutCliente"]
            ])->one();
            $model->idProyecto = $_GET["idProyecto"];
            $proyecto = Proyectos::find()->where(['idProyecto' => $_GET["idProyecto"]])->one();


            $model->evento = $proyecto->nombreProyecto;
        }

        return $this->render('create', [
            'model' => $model,
            'cliente' => $elcliente,
            'modelsAddress' => (empty($modelsAddress)) ? [new DetalleCotizacion] : $modelsAddress
        ]);
    }

    public function actionGenerar($idcotizacion, $rutCliente, $rutUsuario, $idempresa)
    {



        $model = $this->findModel($idcotizacion, $rutCliente, $rutUsuario, $idempresa);

        $content = $this->renderPartial('cotipdf', [
            'model' => $model,
        ]);

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
          
        ]);
        return $pdf->render(); 


        // $nombreArchivo = "Cotizacion Nº:" . $model->idcotizacion . " Cliente:" . $model->rutCliente0->nombreCliente . ".pdf";

        // $mpdf->Output($nombreArchivo, 'D');
        // exit;
    }

    public function actionPrueba($idcotizacion, $rutCliente, $rutUsuario, $idempresa)
    {
        try {
            $mpdf = new Mpdf();
            $model = $this->findModel($idcotizacion, $rutCliente, $rutUsuario, $idempresa);
            $mpdf->debug = true;
            $mpdf->WriteHTML($this->renderPartial('cotipdf', [
                'model' => $model,
            ]));
            $nombreArchivo = "Cotizacion Nº:" . $model->idcotizacion . " Cliente:" . $model->rutCliente0->nombreCliente . ".pdf";

            $mpdf->Output($nombreArchivo, 'D');
        } catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception 
            //       name used for catch
            // Process the exception, log, print etc.
            echo $e->getMessage();
        }
    }

    public function actionGenerar23($idcotizacion, $rutCliente, $rutUsuario, $idempresa)
    {

        $mpdf = new Mpdf();
        $model = $this->findModel($idcotizacion, $rutCliente, $rutUsuario, $idempresa);
        $mpdf->WriteHTML($this->renderPartial('oc', [
            'model' => $model,
        ]));
        $nombreArchivo = "Cotizacion Nº:" . $model->idcotizacion . " Cliente:" . $model->rutCliente0->nombreCliente . ".pdf";


        //return $this->render('oc');

        $mpdf->Output($nombreArchivo, 'I');
        exit;
    }

    public function actionGenerarc($idcotizacion, $rutCliente, $rutUsuario, $idempresa)
    {

        $mpdf = new Mpdf();
        $model = $this->findModel($idcotizacion, $rutCliente, $rutUsuario, $idempresa);
        $mpdf->WriteHTML($this->renderPartial('cotipdf', [
            'model' => $model,
        ]));
        $nombreArchivo = "Cotizacion Nº:" . $model->idcotizacion . " Cliente:" . $model->rutCliente0->nombreCliente . ".pdf";

        $mpdf->Output($nombreArchivo, 'D');
        $model->leida = 1;
        $model->save(false);
        exit;
    }
    /**
     * Updates an existing Cotizacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idcotizacion
     * @param integer $rutCliente
     * @param integer $rutUsuario
     * @param integer $idempresa
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idcotizacion, $rutCliente, $rutUsuario, $idempresa)
    {
        SiteController::valid();
        $modelCustomer = $this->findModel($idcotizacion, $rutCliente, $rutUsuario, $idempresa);
        $modelsAddress = $modelCustomer->detalle;


        if ($modelCustomer->load(Yii::$app->request->post())) {



            $oldIDs = ArrayHelper::map($modelsAddress, 'iddetalleCotizacion', 'iddetalleCotizacion');
            $modelsAddress = Modeloso::createMultiple(DetalleCotizacion::classname(), $modelsAddress);
            Modeloso::loadMultiple($modelsAddress, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAddress, 'iddetalleCotizacion', 'iddetalleCotizacion')));



            $valid = $modelCustomer->validate();
            $valid = Modeloso::validateMultiple($modelsAddress) && $valid;
            //var_dump($valid);die();
            if (!$valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelCustomer->save(false)) {
                        if (!empty($deletedIDs)) {
                            DetalleCotizacion::deleteAll(['iddetalleCotizacion' => $deletedIDs]);
                        }
                        foreach ($modelsAddress as $modelAddress) {

                            $modelAddress->idcotizacion = $modelCustomer->idcotizacion;
                            if (!($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'idcotizacion' => $modelCustomer->idcotizacion, 'rutCliente' => $modelCustomer->rutCliente, 'rutUsuario' => $modelCustomer->rutUsuario, 'idempresa' => $modelCustomer->idempresa]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            return $this->redirect(['view', 'idcotizacion' => $modelCustomer->idcotizacion, 'rutCliente' => $modelCustomer->rutCliente, 'rutUsuario' => $modelCustomer->rutUsuario, 'idempresa' => $modelCustomer->idempresa]);
        }

        return $this->render('update', [
            'model' => $modelCustomer,
            'modelsAddress' => (empty($modelsAddress)) ? [new DetalleCotizacion] : $modelsAddress,
            'cliente' => Cliente::findOne($modelCustomer->rutCliente)
        ]);
    }

    public function actionNota($idcotizacion, $rutCliente, $rutUsuario, $idempresa)
    {
        SiteController::valid();
        $modelCustomer = $this->findModel($idcotizacion, $rutCliente, $rutUsuario, $idempresa);
        //   var_dump($modelCustomer);die();
        $modelsAddress = $modelCustomer->detalle;


        if (Yii::$app->request->post()) {
            $model = new NotaVenta();
            $model->load(Yii::$app->request->post());
            // Aqui va la creacion de la nota de venta con los valores
            $cliente = new Cliente();
            $model->evento = Yii::$app->request->post()['Cotizacion']['evento'];
            $model->validez = Yii::$app->request->post()['Cotizacion']['validez'];
            $model->entrega = Yii::$app->request->post()['Cotizacion']['entrega'];
            $model->formaDePago = Yii::$app->request->post()['Cotizacion']['formaDePago'];
            $model->tipoDeMoneda = Yii::$app->request->post()['Cotizacion']['tipoDeMoneda'];
            $model->totalNeto = Yii::$app->request->post()['Cotizacion']['totalNeto'];
            $model->IVA = Yii::$app->request->post()['Cotizacion']['IVA'];
            $model->Total = Yii::$app->request->post()['Cotizacion']['Total'];
            $model->idCotizacion = Yii::$app->request->post()['idCotizacion'];
            if (Yii::$app->request->post()['Cotizacion']['idProyecto']) {
                $model->idProyecto = Yii::$app->request->post()['Cotizacion']['idProyecto'];
            } else {
                $model->idProyecto = 1;
            }
            $model->factura = Yii::$app->request->post()["nota-venta"]["factura"];


            $cliente->load(Yii::$app->request->post());
            $valid = Cliente::findOne($cliente->rutCliente);

            if ($valid) {
                $session = Yii::$app->session;
                $session->open();
                $user_id = $session->get('usuario');
                $model->rutUsuario = $user_id->rutUsuario;
                $model->fecha = date('Y-m-d');;
                $model->estado = 1;
                $model->idempresa = 1;
                $model->rutCliente = $cliente->rutCliente;
                $model->save(false);
                $detalle = Yii::$app->request->post()["DetalleCotizacion"];
                foreach ($detalle as $item) {

                    $detallec = new DetalleNota();

                    $detallec->idproducto = $item["idproducto"];
                    $detallec->cantidad = $item["cantidad"];
                    $detallec->precio = $item["precio"];
                    $detallec->total = $item["total"];
                    $detallec->iva = $item["iva"];
                    $detallec->idNota = $model->idNotaVenta;
                    $detallec->save(false);
                    $producto = Producto::findOne($detallec->idproducto);
                    $producto->stock = $producto->stock - $detallec->cantidad;
                    $producto->save(false);
                }
                //rutUsuario



                //
                return $this->redirect(['nota-venta/index', 'idNotaVenta' => $model->idNotaVenta, 'rutCliente' => $model->rutCliente, 'rutUsuario' => $model->rutUsuario, 'idempresa' => $model->idempresa]);
            }
        }

        return $this->render('_formnota', [
            'model' => $modelCustomer,
            'modelsAddress' => (empty($modelsAddress)) ? [new DetalleCotizacion] : $modelsAddress,
            'cliente' => Cliente::findOne($modelCustomer->rutCliente)
        ]);
    }

    public function actionCorreo($idcotizacion, $rutCliente, $rutUsuario, $idempresa)
    {

        $model = $this->findModel($idcotizacion, $rutCliente, $rutUsuario, $idempresa);
        $lafecha = date('d/m/Y', strtotime($model->fecha));

        $contacto = ContactoCliente::find()->where(["idCliente" => $model->rutContacto])->one();

        if ($model->rutContacto) {

            Yii::$app->mail->compose(['html' => '@app/templates/correo.php'], ['model' => $model])
            ->setFrom('contacto@apolotec.cl')
            ->setTo(['juan.ibanez@outlook.com'])
                ->setSubject(' Cotizacion Nº' . $model->idcotizacion . ' de la fecha: ' . $lafecha . ' ')
                ->send();
            echo 1;
            exit;
        } else {

            Yii::$app->mail->compose(['html' => '@app/templates/correo.php'], ['model' => $model])
                ->setFrom('contacto@apolotec.cl')
                ->setTo(['juan.ibanez@outlook.com'])
                ->setSubject('Empresa Cotizacion Nº' . $model->idcotizacion . ' de la fecha: ' . $lafecha . ' ')
                ->send();
            echo 1;
            exit;
        }
    }
    /**
     * Deletes an existing Cotizacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idcotizacion
     * @param integer $rutCliente
     * @param integer $rutUsuario
     * @param integer $idempresa
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idcotizacion, $rutCliente, $rutUsuario, $idempresa)
    {
        SiteController::valid();
        $detalle = DetalleCotizacion::find()->where(["idcotizacion" => $idcotizacion])->all();

        foreach ($detalle as $d) {
            try {

                $d->delete();
            } catch (\Exception $exception) {
                $d->delete();
            }
        }
        $this->findModel($idcotizacion, $rutCliente, $rutUsuario, $idempresa)->delete();

        return $this->redirect(['index']);
    }

    public function actionListar($id)
    {
        $models = ContactoCliente::find()->where(['rutCliente' => $id])->all();
        if (sizeof($models) > 0) {

            foreach ($models as $model) {
                echo "<option value='" . $model['idCliente'] . "'>" . $model['nombreCliente'] . "</option>";
            }
        } else {
            echo "<option>-Escoge un cliente primero-</option><option></option>";
        }
    }

    /**
     * Finds the Cotizacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idcotizacion
     * @param integer $rutCliente
     * @param integer $rutUsuario
     * @param integer $idempresa
     * @return Cotizacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcotizacion, $rutCliente, $rutUsuario, $idempresa)
    {
        if (($model = Cotizacion::findOne(['idcotizacion' => $idcotizacion, 'rutCliente' => $rutCliente, 'rutUsuario' => $rutUsuario, 'idempresa' => $idempresa])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionTodos()
    {
        $model = Cotizacion::find()->all();

        foreach ($model as $coti) {

            $fechaActual =  date('Y-m-d');
            $fechaCotizacion = date('Y-m-d', strtotime($coti->fecha . ' + 5 days'));
            if ($fechaActual >= $fechaCotizacion) {
                if ($coti->estado == 1) {

                    $coti->estado = 2;
                    $coti->save(false);
                }
            }
        }
    }

    public function actionContar()
    {
        $cventas = NotaVenta::find()->count();
        $tcompras = OrdenIngreso::find()->sum('Total');
        $tventas = NotaVenta::find()->sum('Total');

        $cventas = NotaVenta::find()->count();
        $ccompras = OrdenIngreso::find()->count();
        $ccotizaciones = Cotizacion::find()->count();

        $todo = array(
            'cventas' => number_format($cventas),
            'tcompras' => number_format($tcompras, 0, ' ', '.'),
            'tventas' => number_format($tventas, 0, ' ', '.'),
            'ccotizaciones' => number_format($ccotizaciones),
            'ccompras' => number_format($ccompras),


        );

        return json_encode($todo);
    }

    public function actionCityList($q = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['idproducto' => '', 'nombreProducto' => '']];
        if (!is_null($q)) {
            $query = new Query();
            $query->select('idproducto, nombreProducto')
                ->from('producto')
                ->where(['like', 'nombreProducto', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['idproducto' => $id, 'text' => Producto::find($id)->nombreProducto];
        }
        return $out;
    }

    public function actionContarr($idProyecto)
    {
        $cventas = NotaVenta::find()->where([
            'idProyecto' => $idProyecto
        ])->count();
        $tcompras = OrdenIngreso::find()->where([
            'idProyecto' => $idProyecto
        ])->sum('Total');
        $tventas = NotaVenta::find()->where([
            'idProyecto' => $idProyecto
        ])->sum('Total');
        $ccgastos = GastosProyecto::find()->where([
            'idProyecto' => $idProyecto
        ])->sum('monto');

        $tcotizado = Cotizacion::find()->where([
            'idProyecto' => $idProyecto
        ])->sum('Total');

        $cventas = NotaVenta::find()->where([
            'idProyecto' => $idProyecto
        ])->count();
        $ccompras = OrdenIngreso::find()->where([
            'idProyecto' => $idProyecto
        ])->count();
        $ccotizaciones = Cotizacion::find()->where([
            'idProyecto' => $idProyecto
        ])->count();
        $cgastos = GastosProyecto::find()->where([
            'idProyecto' => $idProyecto
        ])->count();

        $todo = array(
            'cventas' => number_format($cventas),
            'tcompras' => number_format($tcompras, 0, ' ', '.'),
            'tventas' => number_format($tventas, 0, ' ', '.'),
            'ccotizaciones' => number_format($ccotizaciones),
            'ccompras' => number_format($ccompras),
            'ccgastos' => number_format($ccgastos, 0, ' ', '.'),
            'tcotizado' => number_format($tcotizado, 0, ' ', '.'),
        );

        return json_encode($todo);
    }
}
