<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Disponibilidadehorario;

/**
 * DisponibilidadehorarioSearch represents the model behind the search form of `app\models\Disponibilidadehorario`.
 */
class DisponibilidadehorarioSearch extends Disponibilidadehorario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'medico_id'], 'integer'],
            [['dia_da_semana', 'horario_inicio', 'horario_fim'], 'safe'],
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
        $query = Disponibilidadehorario::find();

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
            'id' => $this->id,
            'medico_id' => $this->medico_id,
            'horario_inicio' => $this->horario_inicio,
            'horario_fim' => $this->horario_fim,
        ]);

        $query->andFilterWhere(['ilike', 'dia_da_semana', $this->dia_da_semana]);

        return $dataProvider;
    }
}
