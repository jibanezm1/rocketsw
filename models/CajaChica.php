<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cajaChica".
 *
 * @property int $idCajachica
 * @property int $monto
 * @property int $rutUsuario
 * @property int $estado
 * @property int $saldo
 */
class CajaChica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cajaChica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['monto', 'rutUsuario'], 'required'],
            [['Mes', 'fechaCreacion'], 'safe'],
            [['monto', 'rutUsuario', 'estado', 'saldo'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCajachica' => 'Id Cajachica',
            'monto' => 'Monto',
            'rutUsuario' => 'Rut Usuario',
            'estado' => 'Estado',
            'saldo' => 'Saldo',
        ];
    }
    
     public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['rutUsuario' => 'rutUsuario']);
    }
}
