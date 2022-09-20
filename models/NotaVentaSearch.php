<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NotaVenta;

/**
 * NotaVentaSearch represents the model behind the search form of `app\models\NotaVenta`.
 */
class NotaVentaSearch extends NotaVenta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idNotaVenta', 'estado', 'rutUsuario', 'idempresa', 'idCotizacion'], 'integer'],
            [['fecha', 'evento', 'validez', 'entrega', 'rutCliente', 'formaDePago', 'tipoDeMoneda', 'flete', 'comentarios'], 'safe'],
            [['totalNeto', 'IVA', 'Total'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = NotaVenta::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('cliente');

        // grid filtering conditions
        $query->andFilterWhere([
            'idNotaVenta' => $this->idNotaVenta,
            'fecha' => $this->fecha,
            'totalNeto' => $this->totalNeto,
            'IVA' => $this->IVA,
            'Total' => $this->Total,
            'estado' => $this->estado,
            'rutUsuario' => $this->rutUsuario,
            'idempresa' => $this->idempresa,
            'idCotizacion' => $this->idCotizacion,
        ]);

        $query->andFilterWhere(['like', 'evento', $this->evento])
            ->andFilterWhere(['like', 'validez', $this->validez])
            ->andFilterWhere(['like', 'entrega', $this->entrega])
            ->andFilterWhere(['like', 'formaDePago', $this->formaDePago])
            ->andFilterWhere(['like', 'tipoDeMoneda', $this->tipoDeMoneda])
            ->andFilterWhere(['like', 'flete', $this->flete])
            ->andFilterWhere(['like', 'cliente.nombreCliente', $this->rutCliente])
            ->andFilterWhere(['like', 'comentarios', $this->comentarios]);

        return $dataProvider;
    }
}
