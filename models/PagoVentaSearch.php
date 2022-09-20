<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PagoVenta;

/**
 * PagoVentaSearch represents the model behind the search form of `app\models\PagoVenta`.
 */
class PagoVentaSearch extends PagoVenta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPago', 'idNotaVenta', 'forma', 'idbanco', 'factorizada', 'porcentajePago'], 'integer'],
            [['fecha', 'idFactoring'], 'safe'],
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
        $query = PagoVenta::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'idPago' => $this->idPago,
            'idNotaVenta' => $this->idNotaVenta,
            'forma' => $this->forma,
            'fecha' => $this->fecha,
            'idbanco' => $this->idbanco,
            'factorizada' => $this->factorizada,
            'porcentajePago' => $this->porcentajePago,
        ]);

        $query->andFilterWhere(['like', 'nombreFactorin', $this->nombreFactorin]);

        return $dataProvider;
    }
}
