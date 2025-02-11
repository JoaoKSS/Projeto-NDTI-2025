<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prontuario;

/**
 * ProntuarioSearch represents the model behind the search form of `app\models\Prontuario`.
 */
class ProntuarioSearch extends Prontuario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'paciente_id', 'medico_id'], 'integer'],
            [['data_consulta', 'diagnostico', 'prescricao', 'exames'], 'safe'],
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
        $query = Prontuario::find();

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
            'paciente_id' => $this->paciente_id,
            'medico_id' => $this->medico_id,
            'data_consulta' => $this->data_consulta,
        ]);

        $query->andFilterWhere(['ilike', 'diagnostico', $this->diagnostico])
            ->andFilterWhere(['ilike', 'prescricao', $this->prescricao])
            ->andFilterWhere(['ilike', 'exames', $this->exames]);

        return $dataProvider;
    }
}
