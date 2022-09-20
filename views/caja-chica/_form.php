<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\CajaChica */
/* @var $form yii\widgets\ActiveForm */

$age = array(
    'Enero' => 'Enero',
    'Febrero' => 'Febrero',
    'Marzo' => 'Marzo',
    'Abril' => 'Abril',
    'Mayo' => 'Mayo',
    'Junio' => 'Junio',
    'Julio' => 'Julio',
    'Agosto' => 'Agosto',
    'Septiembre' => 'Septiembre',
    'Octubre' => 'Octubre',
    'Noviembre' => 'Noviembre',
    'DIciembre' => 'DIciembre',

);
?>

<div class="caja-chica-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php  echo $form->field($model, 'Mes')->widget(Select2::className(), [
                'data' => $age
            ]); ?>
   


      <?= $form->field($model, 'rutUsuario')->widget(Select2::className(), [
                    'data' => ArrayHelper::map(app\models\Usuario::find()->orderBy(['nombreUsuario' => SORT_ASC])->all(), 'rutUsuario', 'nombreUsuario'),
                    'options' => [
                        'placeholder' => 'Buscar Usuario ...',
                    ]
                ]); ?>

     <?= $form->field($model, 'monto')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Generar Nueva Caja Chica', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
