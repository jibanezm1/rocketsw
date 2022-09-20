<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;

/**
 * ProductoSearch represents the model behind the search form of `app\models\Producto`.
 */
class ProductoSearch extends Producto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproducto', 'stock'], 'integer'],
            [['SKU', 'nombreProducto', 'descripcionProducto'], 'safe'],
            [['precioLista'], 'number'],
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
        $query = Producto::find();
        //$query->orderBy('nombreProducto asc');

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
            'idproducto' => $this->idproducto,
            'precioLista' => $this->precioLista,
            'stock' => $this->stock,
        ]);

        $query->andFilterWhere(['like', 'SKU', $this->SKU])
            ->andFilterWhere(['like', 'nombreProducto', $this->nombreProducto])
            ->andFilterWhere(['like', 'descripcionProducto', $this->descripcionProducto]);

        return $dataProvider;
    }
}
