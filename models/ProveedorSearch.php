<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proveedor;

/**
 * ProveedorSearch represents the model behind the search form of `app\models\Proveedor`.
 */
class ProveedorSearch extends Proveedor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rutProveedor'], 'integer'],
            [['nombreProveedor', 'direccionProveedor', 'giroProveedor', 'telefonoProveedor', 'regionProveedor', 'comunaProveedor', 'correoProveedor'], 'safe'],
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
        $query = Proveedor::find();

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
            'rutProveedor' => $this->rutProveedor,
        ]);

        $query->andFilterWhere(['like', 'nombreProveedor', $this->nombreProveedor])
            ->andFilterWhere(['like', 'direccionProveedor', $this->direccionProveedor])
            ->andFilterWhere(['like', 'giroProveedor', $this->giroProveedor])
            ->andFilterWhere(['like', 'telefonoProveedor', $this->telefonoProveedor])
            ->andFilterWhere(['like', 'regionProveedor', $this->regionProveedor])
            ->andFilterWhere(['like', 'comunaProveedor', $this->comunaProveedor])
            ->andFilterWhere(['like', 'correoProveedor', $this->correoProveedor]);

        return $dataProvider;
    }
}
