<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medico".
 *
 * @property int $id
 * @property string $nome_completo
 * @property string $crm
 * @property string $telefone_primario
 * @property string|null $telefone_secundario
 * @property string $email
 * @property string $horario_atendimento
 * @property int|null $id_usuario
 * @property string $senha
 *
 * @property Consulta[] $consultas
 * @property DisponibilidadeHorario[] $disponibilidadeHorarios
 * @property Especialidade[] $especialidades
 * @property Medicoespecialidade[] $medicoespecialidades
 * @property Prontuario[] $prontuarios
 * @property Usuario $usuario
 */
class Medico extends \yii\db\ActiveRecord
{
    public $senha;
    public $especialidades_ids; // Criar nova propriedade para IDs das especialidades

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_completo', 'crm', 'telefone_primario', 'email', 'horario_atendimento'], 'required'],
            [['horario_atendimento'], 'string'],
            [['id_usuario'], 'default', 'value' => null],
            [['id_usuario'], 'integer'],
            [['nome_completo', 'email'], 'string', 'max' => 100],
            [['crm'], 'string', 'max' => 20],
            [['telefone_primario', 'telefone_secundario'], 'string', 'max' => 15],
            [['crm'], 'unique'],
            [['email'], 'unique'],
            [['id_usuario'], 'unique'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['id_usuario' => 'id']],
            [['disponibilidadeHorarios', 'especialidades_ids'], 'safe'], // Adicionado para permitir salvamento dos horários e especialidades
            [['especialidades_ids'], 'safe'], // Permitir salvar as especialidades via form
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_completo' => 'Nome Completo',
            'crm' => 'Crm',
            'telefone_primario' => 'Telefone Primario',
            'telefone_secundario' => 'Telefone Secundario',
            'email' => 'Email',
            'horario_atendimento' => 'Horario Atendimento',
            'id_usuario' => 'Email de Usaúrio',
            'especialidades_ids' => 'Especialidades', // Adicionado para exibir o campo no formulário
        ];
    }

    /**
     * Gets query for [[Consultas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consulta::class, ['medico_id' => 'id']);
    }

    /**
     * Gets query for [[DisponibilidadeHorarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisponibilidadeHorarios()
    {
        return $this->hasMany(DisponibilidadeHorario::class, ['medico_id' => 'id']);
    }

    /**
     * Gets query for [[Especialidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidades()
    {
        return $this->hasMany(Especialidade::class, ['id' => 'especialidade_id'])
            ->viaTable('medicoespecialidade', ['medico_id' => 'id']);
    }

    /**
     * Gets query for [[Medicoespecialidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicoespecialidades()
    {
        return $this->hasMany(Medicoespecialidade::class, ['medico_id' => 'id']);
    }

    /**
     * Gets query for [[Prontuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProntuarios()
    {
        return $this->hasMany(Prontuario::class, ['medico_id' => 'id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::class, ['id' => 'id_usuario']);
    }
}
