<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <div class="row">
        <div class="col-lg-6">

            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>


            <?= $form->field($modelUsers, 'nome')->textInput(['autofocus' => true]) ?>
            <?= $form->field($modelUsers, 'sobrenome')->textInput(['autofocus' => true]) ?>
            <?= $form->field($modelUsers, 'telefone')->textInput(['autofocus' => true]) ?>
            <?= $form->field($modelUsers, 'tipo')->radioList([0 => 'Administrado', 1 => 'Comum']); ?>

            <?php if(isset($modelLogin)): ?>
                <?= $form->field($modelLogin, 'email')->textInput(['autofocus' => true]) ?>
                <?= $form->field($modelLogin, 'senha')->textInput(['autofocus' => true,'type' => 'password']) ?>
                <?= $form->field($modelLogin, 'confirma_senha')->textInput(['autofocus' => true,'type' => 'password']) ?>
            <?php endif; ?>

            <div class="form-group">
                <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                <?= Html::a( 'Voltar', ['index'],['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
