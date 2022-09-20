<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalleCotizacion".
 *
 * @property int $iddetalleCotizacion
 * @property int|null $cantidad
 * @property string $tiempo
 * @property float|null $precio
 * @property float $iva
 * @property float $total
 * @property int $idproducto
 * @property int $idcotizacion
 *
 * @property Cotizacion $idcotizacion0
 * @property Producto $idproducto0
 */
class DetalleCotizacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detalleCotizacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cantidad', 'idproducto', 'idcotizacion'], 'integer'],
            [['tiempo', 'iva', 'total', 'idproducto', 'idcotizacion'], 'required'],
            [['precio', 'iva', 'total'], 'number'],
            [['tiempo'], 'string', 'max' => 300],
            [['idcotizacion'], 'exist', 'skipOnError' => true, 'targetClass' => Cotizacion::className(), 'targetAttribute' => ['idcotizacion' => 'idcotizacion']],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddetalleCotizacion' => 'Iddetalle Cotizacion',
            'cantidad' => 'Cantidad',
            'tiempo' => 'Tiempo',
            'precio' => 'Precio',
            'iva' => 'Iva',
            'total' => 'Total',
            'idproducto' => 'Idproducto',
            'idcotizacion' => 'Idcotizacion',
        ];
    }

    /**
     * Gets query for [[Idcotizacion0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcotizacion0()
    {
        return $this->hasOne(Cotizacion::className(), ['idcotizacion' => 'idcotizacion']);
    }

    /**
     * Gets query for [[Idproducto0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdproducto0()
    {
        return $this->hasOne(Producto::className(), ['idproducto' => 'idproducto']);
    }
}
