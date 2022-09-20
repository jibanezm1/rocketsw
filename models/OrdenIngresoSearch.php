<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrdenIngreso;

/**
 * OrdenIngresoSearch represents the model behind the search form of `app\models\OrdenIngreso`.
 */
class OrdenIngresoSearch extends OrdenIngreso
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idordenIngreso'], 'integer'],
            [['fechaIngreso', 'rutProveedor'], 'safe'],
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
        $query = OrdenIngreso::find();

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
        $query->joinWith('rutProveedor0');

        // grid filtering conditions
        $query->andFilterWhere([
            'idordenIngreso' => $this->idordenIngreso,
            'fechaIngreso' => $this->fechaIngreso
            ])->andFilterWhere(['like', 'proveedor.nombreProveedor', $this->rutProveedor]);

        return $dataProvider;
    }
}
