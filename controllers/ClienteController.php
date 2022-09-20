<?php

namespace app\controllers;

use Yii;
use app\models\Cliente;
use app\models\ClienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\SiteController;
use app\models\Contacto;
use app\models\ContactoCliente;
use yii\helpers\ArrayHelper;
use app\models\Modeloso;
use app\models\Proyectos;
use Exception;
use kartik\grid\EditableColumnAction;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class ClienteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'editbook' => [                                       // identifier for your editable column action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => ContactoCliente::className(),                // the model for the record being edited
                'outputValue' => function ($model, $attribute, $key, $index) {
                    return $model->$attribute;      // return any custom output value if desired
                },
                'outputMessage' => function ($model, $attribute, $key, $index) {
                    return '';                                  // any custom error to return after model save
                },
                'showModelErrors' => true,                        // show model validation errors after save
                'errorOptions' => ['header' => '']                // error summary HTML options
                // 'postOnly' => true,
                // 'ajaxOnly' => true,
                // 'findModel' => function($id, $action) {},
                // 'checkAccess' => function($action, $model) {}
            ]
        ]);
    }


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
     * Lists all Cliente models.
     * @return mixed
     */
    public function actionIndex()
    {
        SiteController::valid();

        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(["estado" => 1]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cliente model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        SiteController::valid();

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionProyectos($rutCliente)
    {
        SiteController::valid();
        $cliente = Cliente::find()->where([
            'rutCliente' => $rutCliente
        ])->one();
        $model1 = Proyectos::find()->where([
            'rutCliente' => $rutCliente
        ])->andWhere(["estado" => 1])->all();
        $model2 = Proyectos::find()->where([
            'rutCliente' => $rutCliente
        ])->andWhere(["estado" => 2])->all();
        $model3 = Proyectos::find()->where([
            'rutCliente' => $rutCliente
        ])->andWhere(["estado" => 3])->all();

        return $this->render('proyectos', [
            'model1' => $model1,
            'model2' => $model2,
            'model3' => $model3,
            'cliente' => $cliente,
            'rutCliente' => $rutCliente
        ]);
    }
    /**
     * Creates a new Cliente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        SiteController::valid();

        $model = new Cliente();
        $modelsAddress = [new ContactoCliente];

        if ($model->load(Yii::$app->request->post())) {
            $checkmodel = Cliente::find()->where(['rutCliente' => $model->rutCliente])->one();

            if ($checkmodel) {
                Yii::$app->session->setFlash('error', 'El ID o Rut del Cliente ya existe en la base de datos.');

                return $this->redirect(Yii::$app->request->referrer);
            }


            $model->save(false);
            $detalle = Yii::$app->request->post()["ContactoCliente"];
            foreach ($detalle as $item) {
                $detallec = new ContactoCliente();

                $detallec->nombreCliente = $item["nombreCliente"];
                $detallec->numeroCliente = $item["numeroCliente"];
                $detallec->correoCliente = $item["correoCliente"];

                $detallec->rutCliente  = $model->rutCliente;
                $detallec->save(false);
            }
            return $this->redirect(['view', 'id' => $model->rutCliente]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelsAddress' => (empty($modelsAddress)) ? [new ContactoCliente] : $modelsAddress
        ]);
    }

    public function actionConvertir($id)
    {
        SiteController::valid();

        $model = new Cliente();
        $modelsAddress = [new ContactoCliente];

        if ($model->load(Yii::$app->request->post())) {

            $model->save(false);
            $detalle = Yii::$app->request->post()["ContactoCliente"];
            foreach ($detalle as $item) {
                $detallec = new ContactoCliente();

                $detallec->nombreCliente = $item["nombreCliente"];
                $detallec->numeroCliente = $item["numeroCliente"];
                $detallec->correoCliente = $item["correoCliente"];

                $detallec->rutCliente  = $model->rutCliente;
                $detallec->save(false);
            }
            return $this->redirect(['view', 'id' => $model->rutCliente]);
        }
        $contacto = Contacto::find()->where(["id" => $id])->one();
        $model->telefonoCliente = $contacto->telefono;
        $model->nombreCliente = $contacto->nombre;
        $model->correoCliente = $contacto->correo;
        $modelsAddress[0]["nombreCliente"] = $contacto->nombre;
        $modelsAddress[0]["numeroCliente"] = $contacto->telefono;
        $modelsAddress[0]["correoCliente"] = $contacto->correo;

        return $this->render('create', [
            'model' => $model,
            'modelsAddress' => (empty($modelsAddress)) ? [new ContactoCliente] : $modelsAddress
        ]);
    }

    /**
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        SiteController::valid();

        $modelCustomer = $this->findModel($id);
        $modelsAddress = $modelCustomer->detalle;


        if ($modelCustomer->load(Yii::$app->request->post())) {

            $modelCustomer->save(false);

            return $this->redirect(['view', 'id' => $modelCustomer->rutCliente]);
        }


        return $this->render('update', [
            'model' => $modelCustomer,
            'modelsAddress' => (empty($modelsAddress)) ? [new ContactoCliente] : $modelsAddress,

        ]);
    }

    /**
     * Deletes an existing Cliente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->estado = 2; // Deshabilita;
        $model->save(false);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cliente::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionBuscador()
    {


        $model = Cliente::find()->where(['rutCliente' => Yii::$app->request->post()["rut"]])->asArray()->one();

        return json_encode($model);
    }
}
