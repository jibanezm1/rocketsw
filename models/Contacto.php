<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contacto".
 *
 * @property int $id
 * @property string $nombre
 * @property string $telefono
 * @property string $correo
 * @property string $asunto
 * @property string $mensaje
 */
class Contacto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'telefono', 'correo', 'asunto', 'mensaje'], 'required'],
            [['nombre', 'telefono', 'asunto', 'mensaje'], 'string'],
            [['correo'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'telefono' => 'Telefono',
            'correo' => 'Correo',
            'asunto' => 'Asunto',
            'mensaje' => 'Mensaje',
        ];
    }
}
