<?php

namespace app\controllers;

use Yii;
use app\models\Contacto;
use app\models\ContactoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactoController implements the CRUD actions for Contacto model.
 */
class ContactoController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                // restrict access to
                'Origin' => ['https://apolotec.cl/'],
            ],
        ];
        return $behaviors;
    }

    /**
     * Lists all Contacto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contacto model.
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
     * Creates a new Contacto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contacto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCrear()
    {
        header("Access-Control-Allow-Origin: *");


        $model = new Contacto();
        if (Yii::$app->request->get()) {

            $usuario = Yii::$app->request->get();
            if ($usuario) {
                $model->nombre = $usuario["nombre"];
                $model->correo = $usuario["correo"];
                $model->telefono = $usuario["telefono"];
                $model->asunto = $usuario["asunto"];
                $model->mensaje = $usuario["mensaje"];
                if ($model->save(false)) {

                    // Your user ID: 1875005830
                    // Current chat ID: 1875005830
                    Yii::$app->telegram->sendMessage([
                        'chat_id' => "5473562874",
                        'text' => "Se ha enviado un mensaje al contacto: Nombre:" . $model->nombre . ", correo:" . $model->correo . ", telefono:" . $model->telefono . ", Asunto:" . $model->asunto . " y el mensaje:" . $model->mensaje . " ",
                    ]);
                    Yii::$app->telegram->sendMessage([
                        'chat_id' => "1875005830",
                        'text' => "Se ha enviado un mensaje al contacto: Nombre:" . $model->nombre . ", correo:" . $model->correo . ", telefono:" . $model->telefono . ", Asunto:" . $model->asunto . " y el mensaje:" . $model->mensaje . " ",
                    ]);
                    
                    return 1;
                } else {
                    return 2;
                }
            }
        }

        return 2;
    }

    /**
     * Updates an existing Contacto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contacto model.
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
     * Finds the Contacto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
