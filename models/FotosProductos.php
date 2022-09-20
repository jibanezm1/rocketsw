<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fotosProductos".
 *
 * @property int $idfotosProductos
 * @property string|null $ruta
 * @property string|null $tipoFotografia
 * @property int $idproducto
 *
 * @property Producto $idproducto0
 */
class FotosProductos extends \yii\db\ActiveRecord
{

    public $file2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fotosProductos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproducto'], 'required'],
            [['idproducto'], 'integer'],
            [['tipoFotografia'], 'string', 'max' => 300],
            [['ruta'], 'file', 'skipOnEmpty' => true, 'extensions' => 'gif, jpg, jpeg, png, pdf, doc, docx', 'maxFiles' => 4],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idfotosProductos' => 'Idfotos Productos',
            'ruta' => 'Ruta',
            'tipoFotografia' => 'Tipo Fotografia',
            'idproducto' => 'Idproducto',
        ];
    }

    /**
     * Gets query for [[Idproducto0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdproducto0()
    {
        return $this->hasOne(Producto::className(), ['idproducto' => 'idproducto']);
    }
}
