<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "videos".
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $titulo
 * @property string $video
 * @property string $createdAt
 * @property string $updatedAt
 */
class Videos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'titulo', 'video', 'createdAt', 'updatedAt'], 'required'],
            [['usuario_id', 'titulo'], 'integer'],
            [['video'], 'string'],
            [['createdAt', 'updatedAt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'titulo' => 'Titulo',
            'video' => 'Video',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
