<?php

namespace app\controllers;

use Yii;
use app\models\Producto;
use app\models\ProductoDocumentos;
use app\models\FotosProductos;
use app\models\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\controllers\SiteController;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
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
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        SiteController::valid();

        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        SiteController::valid();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'fotosProductos' => FotosProductos::find()->where(['idproducto' => $id])->all(),
            'documentos' => ProductoDocumentos::find()->where(['idproducto' => $id])->all(),

        ]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        SiteController::valid();

        $model = new Producto();
        $modelo = new ProductoDocumentos();
        $modeloo = new FotosProductos();

        if ($model->load(Yii::$app->request->post())) {

            $foto1 = UploadedFile::getInstances($modeloo, 'ruta');

            $foto2 = UploadedFile::getInstances($modelo, 'ruta');

            //var_dump($foto1);die();
            //var_dump($foto1);die();
            $model->save(false);
            foreach($foto2 as $file){
                $ext1 = explode(".", $file->name);
                $filename = Yii::$app->security->generateRandomString().".".$ext1[1];
                $path =  Yii::$app->basePath  . '/web/productos/' . $filename;
                //var_dump($path);die();
                if($file->saveAs($path)){
                $modelo = new FotosProductos();
                $modelo->ruta = '/productos/' . $filename;
                $modelo->idproducto = $model->idproducto;
                $modelo->save(false);
                }
                

                }
            foreach($foto1 as $file){
                    $ext2 = explode(".", $file->name);
                    $path =  Yii::$app->basePath  . '/web/productos/' .$model->idproducto."-". $file->name;
                   
                    if($file->saveAs($path)){
                        $modeloo = new ProductoDocumentos();
                        $modeloo->ruta = '/productos/' . $model->idproducto."-". $file->name;
                        $modeloo->descripcionArchivo = $file->name;
                        $modeloo->idproducto = $model->idproducto;
                        $modeloo->save(false);
                    }
                   

                    }
              

            return $this->redirect(['view', 'id' => $model->idproducto]);
        }
        
        $maximo = Producto::find()->max('idProducto');
        
        return $this->render('create', [
            'maximo' => $maximo+1,
            'model' => $model,
            'modelo' => $modelo,
            'modeloo' => $modeloo,
        ]);
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        SiteController::valid();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $modelo = new ProductoDocumentos();
            $modeloo = new FotosProductos();

            $foto1 = UploadedFile::getInstances($modeloo, 'ruta');

            $foto2 = UploadedFile::getInstances($modelo, 'ruta');

          if($foto2){
            foreach($foto2 as $file){
                $ext1 = explode(".", $file->name);

                $filename = Yii::$app->security->generateRandomString().".".$ext1[1];

                $path = Yii::$app->basePath  . '/web/productos/' . $filename;
                
                if($file->saveAs($path)){
                    $modelo = new FotosProductos();
                    $modelo->ruta = '/productos/' . $filename;
                    $modelo->idproducto = $model->idproducto;
                    $modelo->save(false);
                }
                

                }
          }

          if($foto1){
            foreach($foto1 as $file){
                $ext2 = explode(".", $file->name);
                $path = Yii::$app->basePath  . '/web/productos/' .$model->idproducto."-". $file->name;
                if($file->saveAs($path)){
                    $modeloo = new ProductoDocumentos();
                    $modeloo->ruta = '/productos/' . $model->idproducto."-". $file->name;
                    $modeloo->descripcionArchivo = $file->name;
                    $modeloo->idproducto = $model->idproducto;
                    $modeloo->save(false);  
                }
                

                }
          }
            $model->save();       
            return $this->redirect(['view', 'id' => $model->idproducto]);
        }

        return $this->render('update', [
            'model' => $model,
            'fotosProductos' => FotosProductos::find()->where(['idproducto' => $id])->all(),
            'documentos' => ProductoDocumentos::find()->where(['idproducto' => $id])->all(),
            'modelo' => new ProductoDocumentos(),
            'modeloo' => new FotosProductos(),

        ]);
    }

    /**
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {   
        $docs =ProductoDocumentos::find()->where(["idproducto" => $id])->all();
        $picture = fotosProductos::find()->where(["idproducto" => $id])->all();

        foreach($docs as $d){
            try{
            chmod(Yii::$app->params['uploadPath']. Yii::$app->basePath .'/web'.$d->ruta,465);
            unlink(Yii::$app->params['uploadPath']. Yii::$app->basePath .'/web'.$d->ruta);
            $d->delete();
            }catch(\Exception $exception){
                $d->delete();
            }
        }
        foreach($picture as $d)
        {   
            //var_dump(Yii::$app->params['uploadPath']. Yii::$app->basePath .'/web'.$d->ruta);die();
            try{
                chmod(Yii::$app->params['uploadPath']. Yii::$app->basePath .'/web'.$d->ruta,465);
                unlink(Yii::$app->params['uploadPath']. Yii::$app->basePath .'/web'.$d->ruta);
                $d->delete();
            }catch (\Exception $exception){
                $d->delete();
            }
         
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionEliminar($id, $id2)
    {   
        $picture = fotosProductos::findOne($id);

        try{
            chmod(Yii::$app->params['uploadPath']. Yii::$app->basePath .'/web'.$picture->ruta,465);
            unlink(Yii::$app->params['uploadPath']. Yii::$app->basePath .'/web'.$picture->ruta);
            $picture->delete();
        }catch (\Exception $exception){
            $picture->delete();
        }
       
        return $this->redirect(['update', 'id' => $id2]);
    }

    public function actionEliminardocumento($id, $id2)
    {   
        $picture = ProductoDocumentos::findOne($id);

        try{
            chmod(Yii::$app->params['uploadPath']. Yii::$app->basePath .'/web'.$picture->ruta,465);
            unlink(Yii::$app->params['uploadPath']. Yii::$app->basePath .'/web'.$picture->ruta);
            $picture->delete();
        }catch (\Exception $exception){
            $picture->delete();
        }
       
        return $this->redirect(['update', 'id' => $id2]);
    }
    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
