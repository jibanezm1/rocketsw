<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "factoring".
 *
 * @property int $idFactoring
 * @property string $nombreFactoring
 */
class Factoring extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'factoring';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreFactoring'], 'required'],
            [['nombreFactoring'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idFactoring' => 'Id Factoring',
            'nombreFactoring' => 'Nombre Factoring',
        ];
    }
}
