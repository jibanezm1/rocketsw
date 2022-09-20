<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Banco;

/**
 * BancoSearch represents the model behind the search form of `app\models\Banco`.
 */
class BancoSearch extends Banco
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idbanco', 'tipoCTA'], 'integer'],
            [['nombreBanco', 'nombreEjecutivo', 'direccionEjecutivo', 'correoEjecutivo', 'telefonoEjecutivo'], 'safe'],
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
        $query = Banco::find();

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
            'idbanco' => $this->idbanco,
            'tipoCTA' => $this->tipoCTA,
        ]);

        $query->andFilterWhere(['like', 'nombreBanco', $this->nombreBanco])
            ->andFilterWhere(['like', 'nombreEjecutivo', $this->nombreEjecutivo])
            ->andFilterWhere(['like', 'direccionEjecutivo', $this->direccionEjecutivo])
            ->andFilterWhere(['like', 'correoEjecutivo', $this->correoEjecutivo])
            ->andFilterWhere(['like', 'telefonoEjecutivo', $this->telefonoEjecutivo]);

        return $dataProvider;
    }
}
