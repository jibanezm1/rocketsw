<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipoUsuario".
 *
 * @property int $idTipoUsuario
 * @property string|null $nombreTipo
 *
 * @property Usuario[] $usuarios
 */
class TipoUsuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoUsuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreTipo'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTipoUsuario' => 'Id Tipo Usuario',
            'nombreTipo' => 'Nombre Tipo',
        ];
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idTipoUsuario' => 'idTipoUsuario']);
    }
}
