<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "especialidade".
 *
 * @property int $id
 * @property string $nome_especialidade
 *
 * @property Consulta[] $consultas
 * @property Medicoespecialidade[] $medicoespecialidades
 * @property Medico[] $medicos
 */
class Especialidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'especialidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_especialidade'], 'required'],
            [['nome_especialidade'], 'string', 'max' => 100],
            [['nome_especialidade'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_especialidade' => 'Nome Especialidade',
        ];
    }

    /**
     * Gets query for [[Consultas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consulta::class, ['especialidade_id' => 'id']);
    }

    /**
     * Gets query for [[Medicoespecialidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicoespecialidades()
    {
        return $this->hasMany(Medicoespecialidade::class, ['especialidade_id' => 'id']);
    }

    /**
     * Gets query for [[Medicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicos()
    {
        return $this->hasMany(Medico::class, ['id' => 'medico_id'])
            ->viaTable('MedicoEspecialidade', ['especialidade_id' => 'id']);
    }
}
