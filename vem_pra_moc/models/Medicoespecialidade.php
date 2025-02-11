<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "MedicoEspecialidade".
 *
 * @property int $medico_id
 * @property int $especialidade_id
 *
 * @property Especialidade $especialidade
 * @property Medico $medico
 */
class Medicoespecialidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicoespecialidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['medico_id', 'especialidade_id'], 'required'],
            [['medico_id', 'especialidade_id'], 'default', 'value' => null],
            [['medico_id', 'especialidade_id'], 'integer'],
            [['medico_id', 'especialidade_id'], 'unique', 'targetAttribute' => ['medico_id', 'especialidade_id']],
            [['especialidade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidade::class, 'targetAttribute' => ['especialidade_id' => 'id']],
            [['medico_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medico::class, 'targetAttribute' => ['medico_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'medico_id' => 'Medico ID',
            'especialidade_id' => 'Especialidade ID',
        ];
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
}
