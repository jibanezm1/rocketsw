<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gastos_proyecto".
 *
 * @property int $idGastos
 * @property string|null $fechaGasto
 * @property string|null $Titulo
 * @property string|null $motivoGasto
 * @property int|null $rutUsuario
 * @property int|null $idProyecto
 * @property string|null $fotoGasto
 */
class GastosProyecto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gastos_proyecto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fechaGasto', 'monto', 'tipoDocumento','tipoRecibo'], 'safe'],
            [['rutUsuario', 'idProyecto'], 'integer'],
            [['Titulo', 'motivoGasto'], 'string', 'max' => 500],
            [['fotoGasto'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idGastos' => 'Id Gastos',
            'fechaGasto' => 'Fecha Gasto',
            'Titulo' => 'Titulo',
            'motivoGasto' => 'Motivo Gasto',
            'rutUsuario' => 'Rut Usuario',
            'idProyecto' => 'Proyecto',
            'fotoGasto' => 'Foto Gasto',
        ];
    }

    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['rutUsuario' => 'rutUsuario']);
    }

    public function getProyecto()
    {
        return $this->hasOne(Proyectos::className(), ['idproyecto' => 'idProyecto']);
    }
}
