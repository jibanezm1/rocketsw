<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "banco".
 *
 * @property int $idbanco
 * @property string $nombreBanco
 * @property int $tipoCTA
 * @property string $nombreEjecutivo
 * @property string $direccionEjecutivo
 * @property string $correoEjecutivo
 * @property string $telefonoEjecutivo
 */
class Banco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreBanco', 'tipoCTA', 'nombreEjecutivo', 'direccionEjecutivo', 'correoEjecutivo', 'telefonoEjecutivo'], 'required'],
            [['tipoCTA'], 'integer'],
            [['nombreBanco', 'nombreEjecutivo'], 'string', 'max' => 300],
            [['direccionEjecutivo', 'correoEjecutivo', 'telefonoEjecutivo'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idbanco' => 'Idbanco',
            'nombreBanco' => 'Nombre Banco',
            'tipoCTA' => 'Tipo Cta',
            'nombreEjecutivo' => 'Nombre Ejecutivo',
            'direccionEjecutivo' => 'Direccion Ejecutivo',
            'correoEjecutivo' => 'Correo Ejecutivo',
            'telefonoEjecutivo' => 'Telefono Ejecutivo',
        ];
    }
}
