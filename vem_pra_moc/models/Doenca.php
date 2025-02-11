<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doenca".
 *
 * @property int $id
 * @property string $descricao
 * @property int $historico_medico_id
 *
 * @property Historicomedico $historicoMedico
 */
class Doenca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doenca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'historico_medico_id'], 'required'],
            [['historico_medico_id'], 'default', 'value' => null],
            [['historico_medico_id'], 'integer'],
            [['descricao'], 'string', 'max' => 255],
            [['historico_medico_id'], 'exist', 'skipOnError' => true, 'targetClass' => Historicomedico::class, 'targetAttribute' => ['historico_medico_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
            'historico_medico_id' => 'Historico Medico ID',
        ];
    }

    /**
     * Gets query for [[HistoricoMedico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoMedico()
    {
        return $this->hasOne(Historicomedico::class, ['id' => 'historico_medico_id']);
    }
}
