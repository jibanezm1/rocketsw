<?php

namespace app\controllers;

use app\models\Comunas;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Producto;

use app\models\ContactForm;
use yii\web\UploadedFile;
use app\models\Usuario;
use  yii\web\Session;



class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    protected function verbs()
    {
        $verbs = parent::verbs();
        $verbs =  [
            'charla' => ['GET', 'POST', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH']
        ];
        return $verbs;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {



        $session = Yii::$app->session;
        $session->open();
        $user_id = $session->get('usuario');

        if ($user_id->idTipoUsuario == 1 || $user_id->idTipoUsuario == 2) {
            return $this->render('index');
        }
    }

    public function actionLogino()
    {
        $model = new Usuario();

        if ($model->load(Yii::$app->request->post())) {

            $valid = Usuario::find()
                ->where(['correo' => Yii::$app->request->post()["Usuario"]["correo"]])
                ->andWhere(['clave' => Yii::$app->request->post()["Usuario"]["clave"]])
                ->one();


            if ($valid) {

                $session = Yii::$app->session;
                $session->open();
                $session->set('usuario', $valid);

                return $this->redirect([
                    'site/inicio',
                    'model' => $valid
                ]);
            }
        }
        $model->clave = '';
        $model->correo = '';
        $this->layout = "login";
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionInicio()
    {
        return $this->render('inicio');
    }

    public function actionComunas($id)
    {
        $contador = Comunas::find()->where(["region_id" => $id])->count();
        $comunas = Comunas::find()->where(["region_id" => $id])->all();

        if($contador>0){

            foreach($comunas as $comuna){
                echo "<option value=".$comuna->id.">".$comuna->comuna."</option>";
            }

        }else{
            return "<option> - </option>";
        }

    }

    public function actionLogin()
    {



        $model = new Usuario();

        if ($model->load(Yii::$app->request->post())) {

            $valid = Usuario::find()
                ->where(['correo' => Yii::$app->request->post()["Usuario"]["correo"]])
                ->andWhere(['clave' => Yii::$app->request->post()["Usuario"]["clave"]])
                ->one();


            if ($valid) {

                $session = Yii::$app->session;
                $session->open();
                $session->set('usuario', $valid);

                return $this->redirect([
                    'index',
                    'model' => $valid
                ]);
            }
        }
        $model->clave = '';
        $model->correo = '';
        $this->layout = "login";
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionProductos()
    {
        $this->layout = "login";
        $model = Producto::find()->all();
        //var_dump($model);die();
        return $this->render('about', [
            'model' => $model
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public static function valid()
    {
        $session = Yii::$app->session;
        $session->open();
        $user_id = $session->get('usuario');

        if (!$user_id) {
            Yii::$app->getResponse()->redirect('../site/login');
        }
    }

    public static function actionInvalid()
    {
        $session = Yii::$app->session;
        $session->destroy();

        Yii::$app->getResponse()->redirect('../site/login');
    }
}
