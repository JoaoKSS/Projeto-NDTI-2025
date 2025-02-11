<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medicamento".
 *
 * @property int $id
 * @property string $nome_medicamento
 * @property int $historico_medico_id
 *
 * @property Historicomedico $historicoMedico
 */
class Medicamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_medicamento', 'historico_medico_id'], 'required'],
            [['historico_medico_id'], 'default', 'value' => null],
            [['historico_medico_id'], 'integer'],
            [['nome_medicamento'], 'string', 'max' => 255],
            [['historico_medico_id'], 'exist', 'skipOnError' => true, 'targetClass' => Historicomedico::class, 'targetAttribute' => ['historico_medico_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_medicamento' => 'Nome Medicamento',
            'historico_medico_id' => 'Historico Medico ID',
        ];
    }

    /**
     * Gets query for [[HistoricoMedico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoMedico()
    {
        return $this->hasOne(Historicomedico::class, ['id' => 'historico_medico_id']);
    }
}
