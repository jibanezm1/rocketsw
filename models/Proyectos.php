<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyectos".
 *
 * @property int $idproyecto
 * @property string|null $fechaCreacion
 * @property string|null $nombreProyecto
 * @property int|null $estadoProyecto
 * @property int|null $rutCliente
 * @property string|null $descripcionProyecto
 */
class Proyectos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fechaCreacion', 'rutUsuario', 'estado'], 'safe'],
            [['estadoProyecto', 'rutCliente'], 'integer'],
            [['nombreProyecto'], 'string', 'max' => 500],
            [['descripcionProyecto'], 'string', 'max' => 400],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproyecto' => 'Idproyecto',
            'fechaCreacion' => 'Fecha Creacion',
            'nombreProyecto' => 'Nombre Proyecto',
            'estadoProyecto' => 'Estado Proyecto',
            'rutCliente' => 'Rut Cliente',
            'descripcionProyecto' => 'Descripcion Proyecto',
        ];
    }

    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['rutCliente' => 'rutCliente']);
    }
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['rutUsuario' => 'rutUsuario']);
    }

}
