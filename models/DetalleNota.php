<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalleNota".
 *
 * @property int $iddetalleNota
 * @property int|null $cantidad
 * @property string $tiempo
 * @property int|null $precio
 * @property float $iva
 * @property float $total
 * @property int $idproducto
 * @property int $idNota
 *
 * @property NotaVenta $idNota0
 */
class DetalleNota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detalleNota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cantidad', 'precio', 'idproducto', 'idNota'], 'integer'],
            [['tiempo', 'iva', 'total', 'idproducto', 'idNota'], 'required'],
            [['iva', 'total'], 'number'],
            [['tiempo'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddetalleNota' => 'Iddetalle Nota',
            'cantidad' => 'Cantidad',
            'tiempo' => 'Tiempo',
            'precio' => 'Precio',
            'iva' => 'Iva',
            'total' => 'Total',
            'idproducto' => 'Idproducto',
            'idNota' => 'Id Nota',
        ];
    }

    /**
     * Gets query for [[IdNota0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdNota0()
    {
        return $this->hasOne(NotaVenta::className(), ['idNotaVenta' => 'idNota']);
    }
    public function getIdproducto0()
    {
        return $this->hasOne(Producto::className(), ['idproducto' => 'idproducto']);
    }
}
