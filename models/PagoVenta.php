<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pago_venta".
 *
 * @property int $idPago
 * @property int $idNotaVenta
 * @property int $forma
 * @property string $fecha
 * @property int $idbanco
 * @property int $factorizada
 * @property string $nombreFactorin
 * @property int $porcentajePago
 */
class PagoVenta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pago_venta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idNotaVenta', 'forma', 'fecha', 'idbanco', 'factorizada', 'porcentajePago'], 'required'],
            [['idNotaVenta', 'forma', 'idbanco', 'factorizada', 'porcentajePago', 'idFactoring'], 'integer'],
            [['fecha', 'imagen'], 'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPago' => 'Id Pago',
            'idNotaVenta' => 'Id Nota Venta',
            'forma' => 'Forma',
            'fecha' => 'Fecha',
            'idbanco' => 'Idbanco',
            'factorizada' => 'Factorizada',
            'idFactoring' => 'Nombre Factorin',
            'porcentajePago' => 'Porcentaje Pago',
        ];
    }
      public function getVenta()
    {
        return $this->hasOne(NotaVenta::className(), ['idNotaVenta' => 'idNotaVenta']);
    }
      public function getFactoring()
    {
        return $this->hasOne(Factoring::className(), ['idFactoring' => 'idFactoring']);
    }
    
      public function getBanco()
    {
        return $this->hasOne(Banco::className(), ['idbanco' => 'idbanco']);
    }
}
