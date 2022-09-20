<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property int $idempresa
 * @property int|null $rutEmpresa
 * @property string|null $dv
 * @property string|null $nombreEmpresa
 *
 * @property NotaVenta[] $notaVentas
 * @property Cotizacion[] $cotizacions
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rutEmpresa'], 'integer'],
            [['dv'], 'string', 'max' => 1],
            [['nombreEmpresa'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idempresa' => 'Idempresa',
            'rutEmpresa' => 'Rut Empresa',
            'dv' => 'Dv',
            'nombreEmpresa' => 'Nombre Empresa',
        ];
    }

    /**
     * Gets query for [[NotaVentas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotaVentas()
    {
        return $this->hasMany(NotaVenta::className(), ['idempresa' => 'idempresa']);
    }

    /**
     * Gets query for [[Cotizacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacions()
    {
        return $this->hasMany(Cotizacion::className(), ['idempresa' => 'idempresa']);
    }
}
