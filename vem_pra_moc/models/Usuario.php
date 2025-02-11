<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string $senha
 * @property string $tipo_usuario
 * @property string|null $data_cadastro
 *
 * @property Administrador $administrador
 * @property Medico $medico
 * @property Paciente $paciente
 * @property Recepcionista $recepcionista
 */
class Usuario extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'email', 'senha', 'tipo_usuario'], 'required'],
            [['data_cadastro'], 'safe'],
            [['nome'], 'string', 'max' => 100],
            [['email', 'senha'], 'string', 'max' => 255],
            [['tipo_usuario'], 'string', 'max' => 20],
            [['email'], 'unique'],
            [['tipo_usuario'], 'in', 'range' => ['Administrador', 'Medico', 'Paciente', 'Atendente']], // Add this line
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
            'email' => 'Email',
            'senha' => 'Senha',
            'tipo_usuario' => 'Tipo Usuario',
            'data_cadastro' => 'Data Cadastro',
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->data_cadastro = new \yii\db\Expression('CURRENT_TIMESTAMP');
        }

        if ($this->isAttributeChanged('senha') && !$this->isPasswordHashed($this->senha)) {
            $this->senha = Yii::$app->getSecurity()->generatePasswordHash($this->senha);
        }

        return parent::beforeSave($insert);
    }

    private function isPasswordHashed($password)
    {
        return preg_match('/^\$2[axy]\$(\d\d)\$[\.\/0-9A-Za-z]{22}/', $password);
    }

    /**
     * Sets the password hash.
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->senha = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->senha);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Implementar se necessário
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        // Implementar se necessário
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        // Implementar se necessário
        return false;
    }

    /**
     * Gets query for [[Administrador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrador()
    {
        return $this->hasOne(Administrador::class, ['id_administrador' => 'id']);
    }

    /**
     * Gets query for [[Medico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedico()
    {
        return $this->hasOne(Medico::class, ['id_usuario' => 'id']);
    }

    /**
     * Gets query for [[Paciente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaciente()
    {
        return $this->hasOne(Paciente::class, ['id_usuario' => 'id']);
    }

    /**
     * Gets query for [[Recepcionista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecepcionista()
    {
        return $this->hasOne(Recepcionista::class, ['id_recepcionista' => 'id']);
    }

    /**
     * Certifique-se de que a propriedade 'nome' está definida e preenchida corretamente
     */
    public function getNome()
    {
        return $this->nome;
    }
}
