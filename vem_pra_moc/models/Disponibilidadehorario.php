<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disponibilidadehorario".
 *
 * @property int $id
 * @property int $medico_id
 * @property string $dia_da_semana
 * @property string $horario_inicio
 * @property string $horario_fim
 *
 * @property Medico $medico
 */
class Disponibilidadehorario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disponibilidadehorario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['medico_id', 'dia_da_semana', 'horario_inicio', 'horario_fim'], 'required'],
            [['medico_id'], 'integer'],
            [['horario_inicio', 'horario_fim'], 'safe'],
            [['dia_da_semana'], 'string', 'max' => 9],
            [['medico_id', 'dia_da_semana'], 'unique', 'targetAttribute' => ['medico_id', 'dia_da_semana']],
            [['medico_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medico::class, 'targetAttribute' => ['medico_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'medico_id' => 'Medico ID',
            'dia_da_semana' => 'Dia Da Semana',
            'horario_inicio' => 'Horario Inicio',
            'horario_fim' => 'Horario Fim',
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
}
