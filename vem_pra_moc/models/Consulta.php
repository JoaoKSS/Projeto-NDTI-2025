<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "consulta".
 *
 * @property int $id
 * @property int $paciente_id
 * @property int $medico_id
 * @property int $especialidade_id
 * @property string $hora_consulta
 * @property string|null $status
 * @property int $disponibilidade_id
 *
 * @property Disponibilidadehorario $disponibilidade
 * @property Especialidade $especialidade
 * @property Medico $medico
 * @property Paciente $paciente
 */
class Consulta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'consulta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paciente_id', 'medico_id', 'especialidade_id', 'hora_consulta', 'disponibilidade_id'], 'required'],
            [['paciente_id', 'medico_id', 'especialidade_id', 'disponibilidade_id'], 'default', 'value' => null],
            [['paciente_id', 'medico_id', 'especialidade_id', 'disponibilidade_id'], 'integer'],
            [['hora_consulta'], 'safe'],
            [['status'], 'string', 'max' => 20],
            [['status'], 'in', 'range' => ['Agendado', 'Cancelado', 'Realizado']], // Adicionado para validar os valores permitidos
            [['disponibilidade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Disponibilidadehorario::class, 'targetAttribute' => ['disponibilidade_id' => 'id']],
            [['especialidade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidade::class, 'targetAttribute' => ['especialidade_id' => 'id']],
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
            'paciente_id' => 'Paciente',
            'medico_id' => 'Médico',
            'especialidade_id' => 'Especialidade',
            'hora_consulta' => 'Hora Consulta',
            'status' => 'Status',
            'disponibilidade_id' => 'Disponibilidade',
        ];
    }

    /**
     * Gets query for [[Disponibilidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisponibilidade()
    {
        return $this->hasOne(Disponibilidadehorario::class, ['id' => 'disponibilidade_id']);
    }

    /**
     * Gets query for [[Especialidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidade()
    {
        return $this->hasOne(Especialidade::class, ['id' => 'especialidade_id']);
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
