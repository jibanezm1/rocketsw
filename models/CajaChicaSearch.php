<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CajaChica;

/**
 * CajaChicaSearch represents the model behind the search form of `app\models\CajaChica`.
 */
class CajaChicaSearch extends CajaChica
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCajachica', 'monto', 'rutUsuario', 'estado', 'saldo'], 'integer'],
            [['mes', 'fechaCreacion'], 'safe'],

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
        $query = CajaChica::find();

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
            'idCajachica' => $this->idCajachica,
            'monto' => $this->monto,
            'rutUsuario' => $this->rutUsuario,
            'estado' => $this->estado,
            'saldo' => $this->saldo,
        ]);

        return $dataProvider;
    }
}
