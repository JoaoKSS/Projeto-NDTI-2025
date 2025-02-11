<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recepcionista".
 *
 * @property int $id_recepcionista
 *
 * @property Usuario $recepcionista
 */
class Recepcionista extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recepcionista';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_recepcionista'], 'required'],
            [['id_recepcionista'], 'default', 'value' => null],
            [['id_recepcionista'], 'integer'],
            [['id_recepcionista'], 'unique'],
            [['id_recepcionista'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['id_recepcionista' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_recepcionista' => 'Id Recepcionista',
        ];
    }

    /**
     * Gets query for [[Recepcionista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecepcionista()
    {
        return $this->hasOne(Usuario::class, ['id' => 'id_recepcionista']);
    }
}
