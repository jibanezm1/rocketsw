<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form of `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rutUsuario', 'idTipoUsuario'], 'integer'],
            [['dv', 'nombreUsuario', 'apellidosUsuario', 'fechaIngreso', 'clave', 'correo', 'telefono'], 'safe'],
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
        $query = Usuario::find();

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
            'rutUsuario' => $this->rutUsuario,
            'fechaIngreso' => $this->fechaIngreso,
            'idTipoUsuario' => $this->idTipoUsuario,
        ]);

        $query->andFilterWhere(['like', 'dv', $this->dv])
            ->andFilterWhere(['like', 'nombreUsuario', $this->nombreUsuario])
            ->andFilterWhere(['like', 'apellidosUsuario', $this->apellidosUsuario])
            ->andFilterWhere(['like', 'clave', $this->clave])
            ->andFilterWhere(['like', 'correo', $this->correo])
            ->andFilterWhere(['like', 'telefono', $this->telefono]);

        return $dataProvider;
    }
}
