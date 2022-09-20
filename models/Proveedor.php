<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedor".
 *
 * @property int $rutProveedor
 * @property string|null $nombreProveedor
 * @property string|null $direccionProveedor
 * @property string|null $giroProveedor
 * @property string|null $telefonoProveedor
 * @property string|null $regionProveedor
 * @property string|null $comunaProveedor
 * @property string|null $correoProveedor
 *
 * @property OrdenIngreso[] $ordenIngresos
 */
class Proveedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rutProveedor'], 'required'],
            [['rutProveedor'], 'integer'],
            [['contacto'], 'safe'],
            [['nombreProveedor', 'direccionProveedor', 'giroProveedor'], 'string', 'max' => 300],
            [['telefonoProveedor'], 'string', 'max' => 45],
            [['regionProveedor', 'comunaProveedor', 'correoProveedor'], 'string', 'max' => 100],
            [['rutProveedor'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rutProveedor' => 'Rut Proveedor',
            'nombreProveedor' => 'Nombre Proveedor',
            'direccionProveedor' => 'Direccion Proveedor',
            'giroProveedor' => 'Giro Proveedor',
            'telefonoProveedor' => 'Telefono Proveedor',
            'regionProveedor' => 'Region Proveedor',
            'comunaProveedor' => 'Comuna Proveedor',
            'correoProveedor' => 'Correo Proveedor',
        ];
    }

    /**
     * Gets query for [[OrdenIngresos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenIngresos()
    {
        return $this->hasMany(OrdenIngreso::className(), ['rutProveedor' => 'rutProveedor']);
    }
}
