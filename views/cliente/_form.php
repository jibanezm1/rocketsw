<?php

use app\models\ContactoCliente;
use app\models\ContactoClienteSearch;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">


    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-md-3">
            <?php
            
            if($model->isNewRecord){
                echo $form->field($model, 'rutCliente')->textInput();
            }else{
               echo  $form->field($model, 'rutCliente')->textInput([
                    'readonly' => true,
                ]);
            }
            
             ?>
        </div>
        <div class="col-md-3"><?= $form->field($model, 'nombreCliente')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'direccionCliente')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'giroCliente')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-3"><?= $form->field($model, 'telefonoCliente')->textInput() ?></div>
        <div class="col-md-3">
            <?= $form->field($model, "regionCliente")->widget(Select2::className(), [
                'data' => ArrayHelper::map(app\models\Region::find()->orderBy(['idregion' => SORT_ASC])->all(), 'idregion', 'nombreRegion'),
                'options' => [
                    'onchange' => '$.post("' . Yii::$app->urlManager->createUrl(["site/comunas?id="]) . '"+$(this).val(), function( data ) {
                        $("#cliente-comunacliente").html( data );
                    })'
                ]

            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, "comunaCliente")->widget(Select2::className(), [
                'data' => ArrayHelper::map(app\models\Comunas::find()->orderBy(['id' => SORT_ASC])->all(), 'id', 'comuna')
            ]); ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'correoCliente')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <?php

    if ($modelsAddress) {
    ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 30, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsAddress[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'nombreContacto',
                        'telefonoContacto',
                        'correoContacto',
                    ],
                ]); ?>

                <div class="container-items">
                    <!-- widgetContainer -->
                    <?php
                    $a = 0;
                    foreach ($modelsAddress as $i => $modelAddress) : ?>
                        <div class="panel-heading">

                            <div class="clearfix"></div>
                            <?php if ($i == 0) {
                            ?>
                                <div class="row">
                                    <div style="text-align: center;" class="col-sm-4">
                                        <p>Nombre Contacto</p>
                                    </div>
                                    <div style="text-align: center;" class="col-sm-4">
                                        <p>Telefono Contacto</p>
                                    </div>
                                    <div style="text-align: center;" class="col-sm-3">
                                        <p>Correo Contacto</p>
                                    </div>
                                    <div style="text-align: center;" class="col-sm-1">
                                        <p>Acciones</p>
                                    </div>

                                </div>
                            <?php
                            } ?>
                        </div>
                        <br>
                        <div class="item panel panel-default">
                            <!-- widgetBody -->

                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (!$modelAddress->isNewRecord) {
                                    echo Html::activeHiddenInput($modelAddress, "[{$i}]idCliente");
                                }
                                ?>


                                <div class="row">

                                    <div style="text-align: center;" class="col-sm-4">

                                        <?= $form->field($modelAddress, "[{$i}]nombreCliente")->textInput(['maxlength' => true])->label(false) ?>


                                    </div>
                                    <div style="text-align: center;" class="col-sm-4">
                                        <?= $form->field($modelAddress, "[{$i}]numeroCliente")->textInput(['maxlength' => true])->label(false) ?>
                                    </div>

                                    <div style="text-align: center;" class="col-sm-3">
                                        <?= $form->field($modelAddress, "[{$i}]correoCliente")->textInput(['maxlength' => true])->label(false) ?>
                                    </div>




                                    <div class="col-sm-1">
                                        <div style="text-align: center;">
                                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                        </div>
                                    </div>
                                </div><!-- .row -->
                            </div>
                        </div>
                    <?php $a++;
                    endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn bg-purple']) ?>
        </div>
    <?php
    }

    ?>








    <?php
    if (!$modelsAddress) {


        $searchModel = new ContactoClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(["rutCliente" => $model->rutCliente]);
        echo  GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,

            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'idCliente',
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'nombreCliente',
                    'vAlign' => 'middle',
                    'headerOptions' => ['class' => 'kv-sticky-column'],
                    'contentOptions' => ['class' => 'kv-sticky-column'],
                    'editableOptions' => [
                        'asPopover' => false,
                        'formOptions' => ['action' => ['/cliente/editbook']],
                    ]

                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'correoCliente',
                    'vAlign' => 'middle',
                    'headerOptions' => ['class' => 'kv-sticky-column'],
                    'contentOptions' => ['class' => 'kv-sticky-column'],
                    'editableOptions' => [
                        'asPopover' => false,
                        'formOptions' => ['action' => ['/cliente/editbook']],
                    ]

                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'numeroCliente',
                    'vAlign' => 'middle',
                    'headerOptions' => ['class' => 'kv-sticky-column'],
                    'contentOptions' => ['class' => 'kv-sticky-column'],
                    'editableOptions' => [
                        'asPopover' => false,
                        'formOptions' => ['action' => ['/cliente/editbook']],
                    ]

                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => "{delete}",
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/contacto-cliente/delete', 'id' => $model->idCliente], ['title' => 'Excluir', 'data-method' => 'post', 'data-confirm' => "Deseja realmente excluir este item?"]);
                        },
                    ],
                ],
            ],
        ]);
    ?>

        <div class="form-group">
            <?= Html::a(Yii::t('app', 'Agregar un nuevo Contacto '), ['contacto-cliente/create', 'rutCliente' => $model->rutCliente], ['class' => 'btn btn-success da']) ?>
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn bg-purple']) ?>

        </div>
    <?php
    }

    ?>

    <?php ActiveForm::end(); ?>

</div>