<?php

namespace app\controllers;

use Yii;
use app\models\Proyectos;
use app\models\Cotizacion;
use app\models\GastosProyecto;
use app\models\NotaVenta;
use app\models\OrdenIngreso;
use app\models\ProyectosSearch;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill as fill; // Instead PHPExcel_Style_Fill
use PhpOffice\PhpSpreadsheet\Style\Color as color_; //Instead PHPExcel_Style_Color


/**
 * ProyectosController implements the CRUD actions for Proyectos model.
 */
class ProyectosController extends Controller
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
     * Lists all Proyectos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProyectosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Proyectos model.
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
     * Creates a new Proyectos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionEljota($id)
    {

        try {
            $styleArray = array(
                'font'  => array(
                    'bold' => true,
                    'color' => array('rgb' => 'EFF1F5'),
                    'name' => 'Verdana'
                )
            );
            $styleArray2 = array(
                'font'  => array(
                    'bold' => true,
                    'color' => array('rgb' => '1B1C1E'),
                    'name' => 'Verdana'
                )
            );
            // $objPHPExcel = new \PHPExcel();
            $objPHPExcel = new Spreadsheet();

            $sheet = 0;
            $objPHPExcel->setActiveSheetIndex($sheet);

            $proyecto = Proyectos::find()
                //->joinWith('cliente')
                ->where(['idProyecto' => $id])
                ->one();



            $objPHPExcel->getActiveSheet()->setCellValue('A1', "Hoja de Costo - Cliente: " . $proyecto->cliente->nombreCliente);
            $objPHPExcel->getActiveSheet()->setCellValue('A2', "Proyecto: " . $proyecto->nombreProyecto);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($styleArray2);



            $objPHPExcel->getActiveSheet()->setCellValue('A4', "Ordenes de Compra");
            $objPHPExcel->getActiveSheet()->setTitle("Hoja de Costo")
                ->setCellValue('A5', 'Nº OC')
                ->setCellValue('B5', 'PROVEEDOR')
                ->setCellValue('C5', 'FECHA')
                ->setCellValue('D5', 'TOTAL NETO')
                ->setCellValue('E5', 'RESPONSABLE');


            $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray2);

            $objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('A5')
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');
            $objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('B5')
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');
            $objPHPExcel->getActiveSheet()->getStyle('C5')->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('C5')
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');
            $objPHPExcel->getActiveSheet()->getStyle('D5')->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('D5')
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');
            $objPHPExcel->getActiveSheet()->getStyle('E5')->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('E5')
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');
            $row = 6;

            $oc = OrdenIngreso::find()->where([
                'idProyecto' => $id
            ])->all();
            $montooc = 0;
            foreach ($oc as $f) {
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $f->idordenIngreso);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $f->rutProveedor0->nombreProveedor);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, date('d/m/Y', strtotime($f->fechaIngreso)));
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, "$" . number_format($f->totalNeto, '0', ',', '.'));
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $f->usuario->nombreUsuario);
                $row++;
                $montooc = $f->totalNeto + $montooc;
            }

            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, "Total:");
            $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->applyFromArray($styleArray2);


            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, "$" . number_format($montooc, '0', ',', '.'));











            $row = $row + 3;

            $cot = NotaVenta::find()->where([
                'idProyecto' => $id
            ])->all();
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, "Ventas");
            $row++;
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, "ID VENTA");
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, "CLIENTE");
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, "FECHA VENTA");
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, "TOTAL NETO");
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, "RESPONSABLE");

            $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('A' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');

            $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('B' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');

            $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('C' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');

            $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('D' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');

            $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('E' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');

            $row++;
            $montoven = 0;
            foreach ($cot as $c) {
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $c->idNotaVenta);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $c->rutCliente0->nombreCliente);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, date('d/m/Y', strtotime($c->fecha)));
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, "$" . number_format($c->totalNeto, '0', ',', '.'));

                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $c->rutUsuario0->nombreUsuario);
                $row++;
                $montoven = $c->totalNeto + $montoven;
            }
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, "Total:");
            $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->applyFromArray($styleArray2);

            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, "$" . number_format($montoven, '0', ',', '.'));


            $row = $row + 3;

            $cot = GastosProyecto::find()->where([
                'idProyecto' => $id
            ])->all();
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, "Gastos del proyecto");
            $row++;
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, "ID GASTO");
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, "RESPONSABLE");
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, "FECHA GASTO");
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, "TIPO RECIBO");
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, "TIPO DOCUMENTO");
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, "TITULO");
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, "MONTO");


            $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('A' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');

            $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('B' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');

            $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('C' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');

            $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('D' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');

            $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('E' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');

            $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('F' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');

            $objPHPExcel->getActiveSheet()->getStyle('G' . $row)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()
                ->getStyle('G' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('1B1C1E');

            $row++;
            $montogas = 0;

            foreach ($cot as $c) {
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, "#" . $c->idGastos);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $c->usuario->nombreUsuario);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, date('d/m/Y', strtotime($c->fechaGasto)));

                if ($c->tipoRecibo == 1) {
                    $tipo = "Factura";
                }
                if ($c->tipoRecibo == 2) {
                    $tipo = "Boleta";
                }
                if ($c->tipoRecibo == 3) {
                    $tipo = "Otro";
                }

                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $tipo);
                if ($c->tipoDocumento == 1) {
                    $tipod = "Transferencia";
                }
                if ($c->tipoDocumento == 2) {
                    $tipod = "Efectivo";
                }
                if ($c->tipoDocumento == 3) {
                    $tipod = "Cheque";
                }
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $tipod);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $c->Titulo);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $c->motivoGasto);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row,   "$" . number_format($c->monto, '0', ',', '.'));

                $row++;
                $montogas = $c->monto + $montogas;
            }
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, "Total:");
            $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArray2);


            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, "$" . number_format($montogas, '0', ',', '.'));

            $row = $row + 3;
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, "Compras:");
            $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArray2);


            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, "$" . number_format($montooc, '0', ',', '.'));
            $row++;
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, "Ventas:");
            $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArray2);

            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, "$" . number_format($montoven, '0', ',', '.'));
            $row++;
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, "Gastos:");
            $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArray2);

            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, "$" . number_format($montogas, '0', ',', '.'));
            $row++;
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, "Utilidad del proyecto:");
            $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArray2);


            $resultado = $montoven - ($montooc + $montogas);

            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, "$" . number_format($resultado, '0', ',', '.'));

            $row++;
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, "Porcentaje de rentabilidad:");
            $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArray2);


            $lasuma = ($montooc + $montogas);

            $res = $lasuma / $montoven;

            $res = $res * 100;

            $res = 100 - $res;


            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, number_format($res, '0', ',', '.') . "%");


            $filename = $proyecto->cliente->nombreCliente . "- Proyecto:" . $proyecto->nombreProyecto . ".xls";
            ob_start();

            header('Content-Disposition: attachment;filename=' . $filename . ' ');
            header('Cache-Control: max-age=0');
            $objWriter = new Xlsx($objPHPExcel);

            ob_clean();

            $objWriter->save('php://output');
        } catch (\Exception $exception)
        {
            var_dump($exception);die();
            return $this->redirect('view?id='.$id);
        }
    }


    public function actionCreate()
    {
        $model = new Proyectos();
        if ($model->load(Yii::$app->request->post())) {
            $session = Yii::$app->session;
            $session->open();
            $user_id = $session->get('usuario');
            $model->rutUsuario = $user_id->rutUsuario;
            $model->estadoProyecto = 1;
            $model->save(false);
            return $this->redirect(['cliente/proyectos', 'rutCliente' => $model->rutCliente]);
        } else {
            $rutCliente =  $_GET["rutCliente"];
            $model->rutCliente = $rutCliente;
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Proyectos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idproyecto]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Proyectos model.
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
     * Finds the Proyectos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proyectos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proyectos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
