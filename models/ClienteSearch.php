<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cliente;

/**
 * ClienteSearch represents the model behind the search form of `app\models\Cliente`.
 */
class ClienteSearch extends Cliente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rutCliente'], 'integer'],
            [['nombreCliente', 'direccionCliente', 'giroCliente', 'telefonoCliente', 'regionCliente', 'comunaCliente', 'correoCliente'], 'safe'],
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
        $query = Cliente::find();

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
            'rutCliente' => $this->rutCliente,
        ]);

        $query->andFilterWhere(['like', 'nombreCliente', $this->nombreCliente])
            ->andFilterWhere(['like', 'direccionCliente', $this->direccionCliente])
            ->andFilterWhere(['like', 'giroCliente', $this->giroCliente])
            ->andFilterWhere(['like', 'telefonoCliente', $this->telefonoCliente])
            ->andFilterWhere(['like', 'regionCliente', $this->regionCliente])
            ->andFilterWhere(['like', 'comunaCliente', $this->comunaCliente])
            ->andFilterWhere(['like', 'correoCliente', $this->correoCliente]);

        return $dataProvider;
    }
}
