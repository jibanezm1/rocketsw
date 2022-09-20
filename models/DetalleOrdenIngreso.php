<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalleOrdenIngreso".
 *
 * @property int $iddetalleordeningreso
 * @property int|null $cantidad
 * @property float|null $precio
 * @property int $idproducto
 * @property int $idordenIngreso
 * @property float $total
 * @property float $iva
 *
 * @property Producto $idproducto0
 * @property OrdenIngreso $idordenIngreso0
 */
class DetalleOrdenIngreso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detalleOrdenIngreso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cantidad', 'idproducto', 'idordenIngreso'], 'integer'],
            [[ 'total', 'iva', 'precio'], 'number'],
            [['idproducto', 'idordenIngreso', 'total'], 'required'],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
            [['idordenIngreso'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenIngreso::className(), 'targetAttribute' => ['idordenIngreso' => 'idordenIngreso']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddetalleordeningreso' => 'Iddetalleordeningreso',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'idproducto' => 'Idproducto',
            'idordenIngreso' => 'Idorden Ingreso',
            'total' => 'Total',
            'iva' => 'Iva',
        ];
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

    /**
     * Gets query for [[IdordenIngreso0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdordenIngreso0()
    {
        return $this->hasOne(OrdenIngreso::className(), ['idordenIngreso' => 'idordenIngreso']);
    }
}
