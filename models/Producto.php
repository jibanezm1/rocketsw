<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $idproducto
 * @property string|null $SKU
 * @property string|null $nombreProducto
 * @property string|null $descripcionProducto
 * @property float|null $precioLista
 * @property int|null $stock
 *
 * @property DetalleCotizacion[] $detalleCotizacions
 * @property DetalleNotaVenta[] $detalleNotaVentas
 * @property DetalleOrdenIngreso[] $detalleOrdenIngresos
 * @property FotosProductos[] $fotosProductos
 * @property ProductoDocumentos[] $productoDocumentos
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['precioLista'], 'number'],
            [['stock'], 'integer'],
            [['estado', 'imagen', 'precioTienda'], 'safe'],
            [['precioLista', 'stock', 'SKU', 'nombreProducto', 'descripcionProducto'], 'required'],
            [['SKU'], 'string', 'max' => 100],
            [['nombreProducto'], 'string', 'max' => 200],
            [['descripcionProducto'], 'string', 'max' => 500],
        ];
    }
    


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproducto' => 'Orden',
            'SKU' => 'Sku',
            'nombreProducto' => 'Nombre Producto',
            'descripcionProducto' => 'Descripcion Producto',
            'precioLista' => 'Precio Lista',
            'stock' => 'Stock',
        ];
    }

    /**
     * Gets query for [[DetalleCotizacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleCotizacions()
    {
        return $this->hasMany(DetalleCotizacion::className(), ['idproducto' => 'idproducto']);
    }

    /**
     * Gets query for [[DetalleNotaVentas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleNotaVentas()
    {
        return $this->hasMany(DetalleNotaVenta::className(), ['idproducto' => 'idproducto']);
    }

    /**
     * Gets query for [[DetalleOrdenIngresos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleOrdenIngresos()
    {
        return $this->hasMany(DetalleOrdenIngreso::className(), ['idproducto' => 'idproducto']);
    }

    /**
     * Gets query for [[FotosProductos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFotosProductos()
    {
        return $this->hasMany(FotosProductos::className(), ['idproducto' => 'idproducto']);
    }

    /**
     * Gets query for [[ProductoDocumentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductoDocumentos()
    {
        return $this->hasMany(ProductoDocumentos::className(), ['idproducto' => 'idproducto']);
    }
}
