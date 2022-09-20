<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $rutCliente
 * @property string|null $nombreCliente
 * @property string|null $direccionCliente
 * @property string|null $giroCliente
 * @property string|null $telefonoCliente
 * @property string|null $regionCliente
 * @property string|null $comunaCliente
 * @property string|null $correoCliente
 *
 * @property NotaVenta[] $notaVentas
 * @property Cotizacion[] $cotizacions
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rutCliente'], 'required'],
            [['estado'], 'safe'],
            [['nombreCliente', 'direccionCliente', 'giroCliente'], 'string', 'max' => 300],
            [['telefonoCliente'], 'string', 'max' => 45],
            [['regionCliente', 'comunaCliente', 'correoCliente'], 'string', 'max' => 100],
            [['rutCliente'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rutCliente' => 'Rut Cliente O ID (cualquiera)',
            'nombreCliente' => 'Nombre Cliente',
            'direccionCliente' => 'Direccion Cliente',
            'giroCliente' => 'Giro Cliente',
            'telefonoCliente' => 'Telefono Cliente',
            'regionCliente' => 'Region Cliente',
            'comunaCliente' => 'Comuna Cliente',
            'correoCliente' => 'Correo Cliente',
        ];
    }

    /**
     * Gets query for [[NotaVentas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotaVentas()
    {
        return $this->hasMany(NotaVenta::className(), ['rutCliente' => 'rutCliente']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['idregion' => 'regionCliente']);
    }

    public function getComu()
    {
        return $this->hasOne(Comunas::className(), ['id' => 'comunaCliente']);
    }

    /**
     * Gets query for [[Cotizacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacions()
    {
        return $this->hasMany(Cotizacion::className(), ['rutCliente' => 'rutCliente']);
    }
       public function getDetalle()
    {
        return $this->hasMany(ContactoCliente::className(), ['rutCliente' => 'rutCliente']);
    }
}
