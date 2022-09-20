<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
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
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $rutUsuario
     * @param integer $idTipoUsuario
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($rutUsuario, $idTipoUsuario)
    {
        return $this->render('view', [
            'model' => $this->findModel($rutUsuario, $idTipoUsuario),
        ]);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuario();

        if ($model->load(Yii::$app->request->post())) {
            $model->fechaIngreso = date('Y-m-d');
            $model->save(false);
            return $this->redirect(['view', 'rutUsuario' => $model->rutUsuario, 'idTipoUsuario' => $model->idTipoUsuario]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $rutUsuario
     * @param integer $idTipoUsuario
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($rutUsuario, $idTipoUsuario)
    {
        $model = $this->findModel($rutUsuario, $idTipoUsuario);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rutUsuario' => $model->rutUsuario, 'idTipoUsuario' => $model->idTipoUsuario]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $rutUsuario
     * @param integer $idTipoUsuario
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($rutUsuario, $idTipoUsuario)
    {
        $this->findModel($rutUsuario, $idTipoUsuario)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $rutUsuario
     * @param integer $idTipoUsuario
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($rutUsuario, $idTipoUsuario)
    {
        if (($model = Usuario::findOne(['rutUsuario' => $rutUsuario, 'idTipoUsuario' => $idTipoUsuario])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
