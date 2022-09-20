<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contactoCliente".
 *
 * @property int $idCliente
 * @property string $nombreCliente
 * @property string $correoCliente
 * @property string $numeroCliente
 * @property int $rutCliente
 */
class ContactoCliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contactoCliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreCliente', 'correoCliente', 'numeroCliente', 'rutCliente'], 'required'],
            [['rutCliente'], 'integer'],
            [['nombreCliente', 'correoCliente', 'numeroCliente'], 'string', 'max' => 400],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCliente' => 'Id Cliente',
            'nombreCliente' => 'Nombre Cliente',
            'correoCliente' => 'Correo Cliente',
            'numeroCliente' => 'Numero Cliente',
            'rutCliente' => 'Rut Cliente',
        ];
    }
}
