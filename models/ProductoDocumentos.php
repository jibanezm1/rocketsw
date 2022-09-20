<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productoDocumentos".
 *
 * @property int $idproductoDocumentos
 * @property string|null $ruta
 * @property string|null $descripcionArchivo
 * @property int $idproducto
 *
 * @property Producto $idproducto0
 */
class ProductoDocumentos extends \yii\db\ActiveRecord
{

    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productoDocumentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproducto'], 'required'],
            [['idproducto'], 'integer'],
            [['ruta'], 'file', 'skipOnEmpty' => true, 'extensions' => 'gif, jpg, png, pdf, doc, docx', 'maxFiles' => 4],
            [['descripcionArchivo'], 'string', 'max' => 200],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproductoDocumentos' => 'Idproducto Documentos',
            'ruta' => 'Ruta',
            'descripcionArchivo' => 'Descripcion Archivo',
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
