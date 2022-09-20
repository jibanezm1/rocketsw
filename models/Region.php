<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $idregion
 * @property string|null $nombreRegion
 * @property string|null $ordinal_symbol
 * @property int|null $order
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order'], 'integer'],
            [['nombreRegion', 'ordinal_symbol'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idregion' => 'Idregion',
            'nombreRegion' => 'Nombre Region',
            'ordinal_symbol' => 'Ordinal Symbol',
            'order' => 'Order',
        ];
    }
}
