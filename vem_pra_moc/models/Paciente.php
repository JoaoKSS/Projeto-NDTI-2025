<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * Esta é a classe de modelo para a tabela "paciente".
 *
 * @property int $id
 * @property string $nome
 * @property string $data_nascimento
 * @property string|null $sexo
 * @property string $rua
 * @property string $numero
 * @property string|null $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $cep
 * @property string $telefone_primario
 * @property string|null $telefone_secundario
 * @property string|null $email
 * @property string $cpf
 * @property string|null $nome_emergencia
 * @property string|null $contato_emergencia
 * @property int|null $id_usuario
 * @property UploadedFile $documento_cpf
 * @property UploadedFile $documento_rg
 * @property UploadedFile $documento_convenio
 *
 * @property Consulta[] $consultas
 * @property Historicomedico[] $historicomedicos
 * @property Prontuario[] $prontuarios
 * @property Usuario $usuario
 */
class Paciente extends \yii\db\ActiveRecord
{
    public $documento_cpf;
    public $documento_rg;
    public $documento_convenio;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paciente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'data_nascimento', 'sexo', 'rua', 'numero', 'bairro', 'cidade', 'estado', 'cep', 'telefone_primario', 'email', 'cpf', 'nome_emergencia', 'contato_emergencia', 'id_usuario'], 'required'],
            [['data_nascimento'], 'safe'],
            [['id_usuario'], 'default', 'value' => null],
            [['id_usuario'], 'integer'],
            [['nome', 'rua', 'complemento', 'bairro', 'cidade', 'email', 'nome_emergencia'], 'string', 'max' => 255],
            [['sexo'], 'string', 'max' => 1],
            [['numero', 'estado', 'cep', 'telefone_primario', 'telefone_secundario', 'cpf', 'contato_emergencia'], 'string', 'max' => 20],
            [['sexo'], 'in', 'range' => ['M', 'F', 'O']],
            [['estado'], 'in', 'range' => ['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO']],
            [['cpf'], 'unique'],
            [['cpf'], 'match', 'pattern' => '/^\d{11}$/', 'message' => 'O CPF deve conter exatamente 11 dígitos.'],
            [['email'], 'unique'],
            [['id_usuario'], 'unique'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['id_usuario' => 'id']],
            ['nome', 'string', 'max' => 100],
            ['estado', 'string', 'max' => 2],
            ['numero', 'string', 'max' => 10],
            ['bairro', 'string', 'max' => 50],
            ['cidade', 'string', 'max' => 50],
            ['cpf', 'string', 'max' => 11],
            ['nome_emergencia', 'string', 'max' => 100],
            [['documento_cpf', 'documento_rg', 'documento_convenio'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf'],
            [['nome_completo'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'data_nascimento' => 'Data de Nascimento',
            'sexo' => 'Sexo',
            'rua' => 'Rua',
            'numero' => 'Número',
            'complemento' => 'Complemento',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'cep' => 'CEP',
            'telefone_primario' => 'Telefone Primário',
            'telefone_secundario' => 'Telefone Secundário',
            'email' => 'Email',
            'cpf' => 'CPF',
            'nome_emergencia' => 'Nome Emergência',
            'contato_emergencia' => 'Contato Emergência',
            'id_usuario' => 'Email de Usaúrio',
        ];
    }

    /**
     * Gets query for [[Consultas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consulta::class, ['paciente_id' => 'id']);
    }

    /**
     * Gets query for [[Historicomedicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricomedicos()
    {
        return $this->hasMany(Historicomedico::class, ['paciente_id' => 'id']);
    }

    /**
     * Gets query for [[Prontuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProntuarios()
    {
        return $this->hasMany(Prontuario::class, ['paciente_id' => 'id']);
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

    /**
     * Gets the nome from Usuario.
     *
     * @return string|null
     */
    public function getNome()
    {
        return $this->usuario ? $this->usuario->nome : null;
    }

    public function getDataNascimentoBrasil()
    {
        return Yii::$app->formatter->asDate($this->data_nascimento, 'php:d/m/Y');
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->cep = str_replace('-', '', $this->cep);
            return true;
        }
        return false;
    }

    public function afterFind()
    {
        parent::afterFind();

        // Carrega os arquivos existentes
        $this->documento_cpf = $this->getUploadedFilePath('cpf');
        $this->documento_rg = $this->getUploadedFilePath('rg');
        $this->documento_convenio = $this->getUploadedFilePath('convenio');
    }

    public function getUploadedFilePath($type)
    {
        $extensions = ['pdf', 'png', 'jpg'];
        foreach ($extensions as $extension) {
            $filePath = 'uploads/' . $this->id . '_' . $type . '.' . $extension;
            if (file_exists($filePath)) {
                return $filePath;
            }
        }
        return null;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // Salva os arquivos enviados, substituindo os existentes se necessário
        if ($this->documento_cpf instanceof UploadedFile) {
            $this->documento_cpf->saveAs('uploads/' . $this->id . '_cpf.' . $this->documento_cpf->extension);
        }
        if ($this->documento_rg instanceof UploadedFile) {
            $this->documento_rg->saveAs('uploads/' . $this->id . '_rg.' . $this->documento_rg->extension);
        }
        if ($this->documento_convenio instanceof UploadedFile) {
            $this->documento_convenio->saveAs('uploads/' . $this->id . '_convenio.' . $this->documento_convenio->extension);
        }
    }
}
