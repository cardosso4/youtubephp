<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property int $user_id
 * @property string $nome
 * @property string $sobrenome
 * @property int $tipo
 * @property string|null $telefone
 * @property string $createdAt
 * @property string $updatedAt
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'nome', 'sobrenome', 'tipo', 'createdAt', 'updatedAt'], 'required'],
            [['user_id', 'tipo'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['nome', 'sobrenome', 'telefone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'nome' => 'Nome',
            'sobrenome' => 'Sobrenome',
            'tipo' => 'Tipo',
            'telefone' => 'Telefone',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
