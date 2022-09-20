<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gastosCajaChica".
 *
 * @property int $id_gastoCajaChica
 * @property string $documento
 * @property int $idCajachica
 * @property int $monto
 * @property string $fechaGasto
 * @property int $idProyecto
 * @property int $idGasto
 */
class GastosCajaChica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gastosCajaChica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documento', 'idCajachica', 'monto', 'fechaGasto'], 'required'],
            [['idCajachica', 'monto', 'idProyecto', 'idGasto'], 'integer'],
            [['fechaGasto', 'motivo'], 'safe'],
            [['documento'], 'string', 'max' => 400],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_gastoCajaChica' => 'Id Gasto Caja Chica',
            'documento' => 'Documento',
            'idCajachica' => 'Id Cajachica',
            'monto' => 'Monto',
            'fechaGasto' => 'Fecha Gasto',
            'idProyecto' => 'Id Proyecto',
            'idGasto' => 'Id Gasto',
        ];
    }
}
