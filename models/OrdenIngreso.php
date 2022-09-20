<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordenIngreso".
 *
 * @property int $idordenIngreso
 * @property string|null $fechaIngreso
 * @property string $forma
 * @property string $medio
 * @property string $terminos
 * @property string $observaciones
 * @property int $rutProveedor
 * @property float $totalNeto
 * @property float $IVA
 * @property float $Total
 *
 * @property DetalleOrdenIngreso[] $detalleOrdenIngresos
 * @property Proveedor $rutProveedor0
 */
class OrdenIngreso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordenIngreso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fechaIngreso', 'pago', 'idProyecto'], 'safe'],
            [['forma', 'medio', 'terminos', 'observaciones', 'rutProveedor', 'totalNeto', 'IVA', 'Total'], 'required'],
            [['rutProveedor'], 'integer'],
            [['totalNeto', 'IVA', 'Total'], 'number'],
            [['forma'], 'string', 'max' => 400],
            [['medio'], 'string', 'max' => 300],
            [['terminos', 'observaciones'], 'string', 'max' => 500],
            [['rutProveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['rutProveedor' => 'rutProveedor']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idordenIngreso' => 'Nº OC',
            'fechaIngreso' => 'Fecha Ingreso',
            'forma' => 'Forma',
            'medio' => 'Medio',
            'terminos' => 'Terminos',
            'observaciones' => 'Observaciones',
            'rutProveedor' => 'Rut Proveedor',
            'totalNeto' => 'Total Neto',
            'IVA' => 'Iva',
            'Total' => 'Total',
        ];
    }

    /**
     * Gets query for [[DetalleOrdenIngresos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleOrdenIngresos()
    {
        return $this->hasMany(DetalleOrdenIngreso::className(), ['idordenIngreso' => 'idordenIngreso']);
    }
    
    
    

    /**
     * Gets query for [[RutProveedor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRutProveedor0()
    {
        return $this->hasOne(Proveedor::className(), ['rutProveedor' => 'rutProveedor']);
    }
    
     public function getProveedor()
    {
        return $this->hasOne(Proveedor::className(), ['rutProveedor' => 'rutProveedor']);
    }

    public function getProyecto()
    {
        return $this->hasOne(Proyectos::className(), ['idProyecto' => 'idProyecto']);
    }

  public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['rutUsuario' => 'rutUsuario']);
    }

    public function getDetalle()
    {
        return $this->hasMany(DetalleOrdenIngreso::className(), ['idordenIngreso' => 'idordenIngreso']);
    }
}
