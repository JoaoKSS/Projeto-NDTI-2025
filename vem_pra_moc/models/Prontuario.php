<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prontuario".
 *
 * @property int $id
 * @property int $paciente_id
 * @property int $medico_id
 * @property string $data_consulta
 * @property string $diagnostico
 * @property string|null $prescricao
 * @property string|null $exames
 *
 * @property Medico $medico
 * @property Paciente $paciente
 */
class Prontuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prontuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paciente_id', 'medico_id', 'diagnostico'], 'required'],
            [['paciente_id', 'medico_id'], 'default', 'value' => null],
            [['paciente_id', 'medico_id'], 'integer'],
            [['data_consulta'], 'safe'],
            [['diagnostico', 'prescricao', 'exames'], 'string'],
            [['medico_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medico::class, 'targetAttribute' => ['medico_id' => 'id']],
            [['paciente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paciente::class, 'targetAttribute' => ['paciente_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'paciente_id' => 'Paciente ID',
            'medico_id' => 'Medico ID',
            'data_consulta' => 'Data Consulta',
            'diagnostico' => 'Diagnostico',
            'prescricao' => 'Prescricao',
            'exames' => 'Exames',
        ];
    }

    /**
     * Gets query for [[Medico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedico()
    {
        return $this->hasOne(Medico::class, ['id' => 'medico_id']);
    }

    /**
     * Gets query for [[Paciente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaciente()
    {
        return $this->hasOne(Paciente::class, ['id' => 'paciente_id']);
    }
}
