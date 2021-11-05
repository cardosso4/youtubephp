<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;


$this->title = 'Cadastro';
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <div class="col-lg-6">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($modelUsers, 'nome')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($modelUsers, 'sobrenome')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($modelUsers, 'telefone')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($modelLogin, 'email')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($modelLogin, 'senha')->textInput(['autofocus' => true,'type' => 'password']) ?>
                    <?= $form->field($modelLogin, 'confirma_senha')->textInput(['autofocus' => true,'type' => 'password']) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

</div>
