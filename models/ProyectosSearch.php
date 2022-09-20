<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proyectos;

/**
 * ProyectosSearch represents the model behind the search form of `app\models\Proyectos`.
 */
class ProyectosSearch extends Proyectos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproyecto', 'estadoProyecto', 'rutCliente'], 'integer'],
            [['fechaCreacion', 'nombreProyecto'], 'safe'],
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
        $query = Proyectos::find();

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
            'idproyecto' => $this->idproyecto,
            'fechaCreacion' => $this->fechaCreacion,
            'estadoProyecto' => $this->estadoProyecto,
            'rutCliente' => $this->rutCliente,
        ]);

        $query->andFilterWhere(['like', 'nombreProyecto', $this->nombreProyecto]);

        return $dataProvider;
    }
}
