<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Medico;

/**
 * MedicoSearch represents the model behind the search form of `app\models\Medico`.
 */
class MedicoSearch extends Medico
{
    public $especialidade; // Adicionar o campo especialidade

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_usuario'], 'integer'],
            [['nome_completo', 'crm', 'telefone_primario', 'telefone_secundario', 'email', 'horario_atendimento', 'especialidade'], 'safe'], // Adicionar especialidade às regras
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
        $query = Medico::find();

        // Adicionar a relação com especialidade
        $query->joinWith(['especialidades']);

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
            'id_usuario' => $this->id_usuario,
        ]);

        $query->andFilterWhere(['ilike', 'nome_completo', $this->nome_completo])
            ->andFilterWhere(['ilike', 'crm', $this->crm])
            ->andFilterWhere(['ilike', 'telefone_primario', $this->telefone_primario])
            ->andFilterWhere(['ilike', 'telefone_secundario', $this->telefone_secundario])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'horario_atendimento', $this->horario_atendimento])
            ->andFilterWhere(['ilike', 'especialidade.nome_especialidade', $this->especialidade]); // Corrigir a referência à coluna

        return $dataProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'especialidade' => 'Especialidade',
        ];
    }
}
