<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cotizacion;

/**
 * CotizacionSearch represents the model behind the search form of `app\models\Cotizacion`.
 */
class CotizacionSearch extends Cotizacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcotizacion', 'estado', 'rutUsuario', 'mail'], 'integer'],
            [['fecha', 'evento', 'validez', 'entrega', 'rutCliente', 'idempresa', 'formaDePago', 'tipoDeMoneda'], 'safe'],
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
        $query = Cotizacion::find();

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
        $query->joinWith('idempresa0');


        // grid filtering conditions
        $query->andFilterWhere([
            'idcotizacion' => $this->idcotizacion,
            'fecha' => $this->fecha,
            'totalNeto' => $this->totalNeto,
            'IVA' => $this->IVA,
            'Total' => $this->Total,
            'estado' => $this->estado,
            'rutUsuario' => $this->rutUsuario,
            'mail' => $this->mail,
        ]);

        $query->andFilterWhere(['like', 'evento', $this->evento])
            ->andFilterWhere(['like', 'validez', $this->validez])
            ->andFilterWhere(['like', 'entrega', $this->entrega])
            ->andFilterWhere(['like', 'cliente.nombreCliente', $this->rutCliente])
            ->andFilterWhere(['like', 'empresa.nombreEmpresa', $this->idempresa])
            ->andFilterWhere(['like', 'formaDePago', $this->formaDePago])
            ->andFilterWhere(['like', 'tipoDeMoneda', $this->tipoDeMoneda]);

        return $dataProvider;
    }
}
