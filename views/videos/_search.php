<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VideosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="videos-search container">

    <div class="row">
        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'class' => 'form-group col-lg-12 col-md-12 col-sm-12 col-xs-12'
            ]); ?>

            <div class="container">
                <div class="row">
                    <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <?= $form->field($model, 'pesquisar') ?>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2-xs-2">
                        <?= $form->field($model, 'limite') ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
