<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "NotaVenta".
 *
 * @property int $idNotaVenta
 * @property string|null $fecha
 * @property float|null $totalNeto
 * @property float|null $IVA
 * @property float|null $Total
 * @property int|null $estado
 * @property int $rutCliente
 * @property int $rutUsuario
 * @property string|null $evento
 * @property string|null $validez
 * @property string|null $entrega
 * @property string|null $formaDePago
 * @property string|null $tipoDeMoneda
 * @property int $idempresa
 * @property string|null $flete
 * @property string|null $comentarios
 * @property int $idCotizacion
 *
 * @property Usuario $rutUsuario0
 * @property Empresa $idempresa0
 * @property Cliente $rutCliente0
 * @property DetalleNota[] $detalleNotas
 * @property DetalleNotaVenta[] $detalleNotaVentas
 */
class NotaVenta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NotaVenta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'idProyecto', 'factura'], 'safe'],
            [['totalNeto', 'IVA', 'Total'], 'number'],
            [['estado', 'rutCliente', 'rutUsuario', 'idempresa', 'idCotizacion'], 'integer'],
            [['rutCliente', 'rutUsuario', 'idempresa', 'idCotizacion',  'factura'], 'required'],
            [['evento', 'validez'], 'string', 'max' => 300],
            [['entrega', 'tipoDeMoneda', 'flete', 'comentarios'], 'string', 'max' => 500],
            [['formaDePago'], 'string', 'max' => 45],
            [['rutUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['rutUsuario' => 'rutUsuario']],
            [['idempresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['idempresa' => 'idempresa']],
            [['rutCliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['rutCliente' => 'rutCliente']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idNotaVenta' => 'ID Venta',
            'fecha' => 'Fecha',
            'totalNeto' => 'Total Neto',
            'IVA' => 'Iva',
            'Total' => 'Total',
            'estado' => 'Estado',
            'rutCliente' => 'Rut Cliente',
            'rutUsuario' => 'Rut Usuario',
            'evento' => 'Evento',
            'validez' => 'Validez',
            'entrega' => 'Entrega',
            'formaDePago' => 'Forma De Pago',
            'tipoDeMoneda' => 'Tipo De Moneda',
            'idempresa' => 'Idempresa',
            'flete' => 'Flete',
            'comentarios' => 'Comentarios',
            'idCotizacion' => 'Id Cotizacion',
        ];
    }

    /**
     * Gets query for [[RutUsuario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRutUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['rutUsuario' => 'rutUsuario']);
    }
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['rutCliente' => 'rutCliente']);
    }

    /**
     * Gets query for [[Idempresa0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdempresa0()
    {
        return $this->hasOne(Empresa::className(), ['idempresa' => 'idempresa']);
    }

    /**
     * Gets query for [[RutCliente0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRutCliente0()
    {
        return $this->hasOne(Cliente::className(), ['rutCliente' => 'rutCliente']);
    }

    public function getProyecto()
    {
        return $this->hasOne(Proyectos::className(), ['idProyecto' => 'idProyecto']);
    }

    /**
     * Gets query for [[DetalleNotas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleNotas()
    {
        return $this->hasMany(DetalleNota::className(), ['idNota' => 'idNotaVenta']);
    }

    /**
     * Gets query for [[DetalleNotaVentas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalle()
    {
        return $this->hasMany(DetalleNota::className(), ['idNota' => 'idNotaVenta']);
    }
    
}
