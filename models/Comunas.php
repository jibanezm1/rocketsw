<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comunas".
 *
 * @property int $id
 * @property string $comuna
 * @property int $region_id
 */
class Comunas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comunas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comuna', 'region_id'], 'required'],
            [['region_id'], 'integer'],
            [['comuna'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comuna' => 'Comuna',
            'region_id' => 'Region ID',
        ];
    }
}
