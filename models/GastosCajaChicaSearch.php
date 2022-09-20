<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GastosCajaChica;

/**
 * GastosCajaChicaSearch represents the model behind the search form of `app\models\GastosCajaChica`.
 */
class GastosCajaChicaSearch extends GastosCajaChica
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_gastoCajaChica', 'idCajachica', 'monto', 'idProyecto', 'idGasto'], 'integer'],
            [['documento', 'fechaGasto', 'motivo'], 'safe'],
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
        $query = GastosCajaChica::find();

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
            'id_gastoCajaChica' => $this->id_gastoCajaChica,
            'idCajachica' => $this->idCajachica,
            'monto' => $this->monto,
            'fechaGasto' => $this->fechaGasto,
            'idProyecto' => $this->idProyecto,
            'idGasto' => $this->idGasto,
        ]);

        $query->andFilterWhere(['like', 'documento', $this->documento])
            ->andFilterWhere(['like', 'motivo', $this->motivo]);

        return $dataProvider;
    }
}
