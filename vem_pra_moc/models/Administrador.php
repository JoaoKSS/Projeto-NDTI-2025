<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "administrador".
 *
 * @property int $id_administrador
 *
 * @property Usuario $administrador
 */
class Administrador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'administrador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_administrador'], 'required'],
            [['id_administrador'], 'default', 'value' => null],
            [['id_administrador'], 'integer'],
            [['id_administrador'], 'unique'],
            [['id_administrador'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['id_administrador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_administrador' => 'Id Administrador',
        ];
    }

    /**
     * Gets query for [[Administrador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrador()
    {
        return $this->hasOne(Usuario::class, ['id' => 'id_administrador']);
    }
}
