<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logins".
 *
 * @property int $id
 * @property string $email
 * @property string $senha
 * @property string $createdAt
 * @property string $updatedAt
 */
class Logins extends \yii\db\ActiveRecord
{

    public $confirma_senha;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logins';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'senha', 'createdAt', 'updatedAt'], 'required'],
            [['createdAt', 'updatedAt','confirma_senha'], 'safe'],
            [['email', 'senha'], 'string', 'max' => 255],
//            [['confirma_senha'], 'string', 'when' => function ($model) {
//                return $model->senha != $model->confirma_senha;
//            }, 'whenClient' => 'function (attribute, value) {
//                var senha = $("#logins-senha").val();
//                var confirma_senha = $("#logins-confirma_senha").val();
//                console.log(senha!=confirma_senha?true:false);
//                console.log(senha);
//                console.log(confirma_senha);
//                return senha!=confirma_senha?"true":"false;
//            }','message' => 'Senha não conferem'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'senha' => 'Senha',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

  }
