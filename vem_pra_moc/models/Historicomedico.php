<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "historicomedico".
 *
 * @property int $id
 * @property string|null $historico_cirurgias
 * @property int $paciente_id
 *
 * @property Alergia[] $alergias
 * @property Doenca[] $doencas
 * @property Medicamento[] $medicamentos
 * @property Paciente $paciente
 */
class Historicomedico extends \yii\db\ActiveRecord
{
    public $alergiasString;
    public $doencasString;
    public $medicamentosString;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historicomedico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['historico_cirurgias'], 'string'],
            [['paciente_id'], 'required'],
            [['paciente_id'], 'default', 'value' => null],
            [['paciente_id'], 'integer'],
            [['paciente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paciente::class, 'targetAttribute' => ['paciente_id' => 'id']],
            [['alergiasString', 'doencasString', 'medicamentosString'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'historico_cirurgias' => 'Histórico de Cirurgias',
            'paciente_id' => 'Paciente ID',
            'alergiasString' => 'Alergias', // Definir o rótulo personalizado
            'doencasString' => 'Doenças',
            'medicamentosString' => 'Medicamentos',
        ];
    }

    /**
     * Gets query for [[Alergias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlergias()
    {
        return $this->hasMany(Alergia::class, ['historico_medico_id' => 'id']);
    }

    /**
     * Gets query for [[Doencas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoencas()
    {
        return $this->hasMany(Doenca::class, ['historico_medico_id' => 'id']);
    }

    /**
     * Gets query for [[Medicamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamentos()
    {
        return $this->hasMany(Medicamento::class, ['historico_medico_id' => 'id']);
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

    public function getAlergiasString()
    {
        $alergias = $this->alergias ?: [];
        return implode(', ', array_map(function($alergia) {
            return $alergia->descricao;
        }, $alergias));
    }

    public function setAlergiasString($value)
    {
        $this->alergiasString = $value;
    }

    public function getDoencasString()
    {
        $doencas = $this->doencas ?: [];
        return implode(', ', array_map(function($doenca) {
            return $doenca->descricao;
        }, $doencas));
    }

    public function setDoencasString($value)
    {
        $this->doencasString = $value;
    }

    public function getMedicamentosString()
    {
        $medicamentos = $this->medicamentos ?: [];
        return implode(', ', array_map(function($medicamento) {
            return $medicamento->nome_medicamento;
        }, $medicamentos));
    }

    public function setMedicamentosString($value)
    {
        $this->medicamentosString = $value;
    }
}
