<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Usuario".
 *
 * @property int $rutUsuario
 * @property string|null $dv
 * @property string|null $nombreUsuario
 * @property string|null $apellidosUsuario
 * @property string|null $fechaIngreso
 * @property int $idTipoUsuario
 * @property string|null $clave
 * @property string|null $correo
 * @property string $telefono
 *
 * @property NotaVenta[] $notaVentas
 * @property TipoUsuario $idTipoUsuario0
 * @property Cotizacion[] $cotizacions
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rutUsuario', 'idTipoUsuario', 'telefono'], 'required'],
            [['rutUsuario', 'idTipoUsuario'], 'integer'],
            [['fechaIngreso'], 'safe'],
            [['dv'], 'string', 'max' => 1],
            [['nombreUsuario', 'apellidosUsuario'], 'string', 'max' => 200],
            [['clave'], 'string', 'max' => 45],
            [['correo'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 300],
            [['rutUsuario', 'idTipoUsuario'], 'unique', 'targetAttribute' => ['rutUsuario', 'idTipoUsuario']],
            [['idTipoUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUsuario::className(), 'targetAttribute' => ['idTipoUsuario' => 'idTipoUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rutUsuario' => 'Rut Usuario',
            'dv' => 'Dv',
            'nombreUsuario' => 'Nombre Usuario',
            'apellidosUsuario' => 'Apellidos Usuario',
            'fechaIngreso' => 'Fecha Ingreso',
            'idTipoUsuario' => 'Perfil del Usuario',
            'clave' => 'Clave',
            'correo' => 'Correo',
            'telefono' => 'Telefono',
        ];
    }

    /**
     * Gets query for [[NotaVentas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotaVentas()
    {
        return $this->hasMany(NotaVenta::className(), ['rutUsuario' => 'rutUsuario', 'Usuario_idTipoUsuario' => 'idTipoUsuario']);
    }

    /**
     * Gets query for [[IdTipoUsuario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoUsuario0()
    {
        return $this->hasOne(TipoUsuario::className(), ['idTipoUsuario' => 'idTipoUsuario']);
    }

    /**
     * Gets query for [[Cotizacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacions()
    {
        return $this->hasMany(Cotizacion::className(), ['rutUsuario' => 'rutUsuario', 'Usuario_idTipoUsuario' => 'idTipoUsuario']);
    }
}
