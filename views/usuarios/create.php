<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Criar Usuarios';

?>
<div class="usuarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelLogin' => $modelLogin,
        'modelUsers' => $modelUsers
    ]) ?>

</div>
