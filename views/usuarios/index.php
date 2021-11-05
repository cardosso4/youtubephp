<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if($dataProvider != null): ?>
        <div class="container">
            <div class="row">
                <h4>Total de resultados encontrados: <?= count($dataProvider); ?></h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Nivel</th>
                            <th style="text-align: center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataProvider as $item): ?>
                            <tr>
                                <td width="60%">
                                    <h3><?= $item->nome.' '.$item->sobrenome ?></h3>
                                </td>
                                <td>
                                    <?= $item->tipo==0?'Administrado':'Comum'; ?>
                                </td>
                                <td style="text-align: center">
                                    <?= Html::a( 'Alterar', ['update','id' => $item->id],['class' => 'btn btn-primary']) ?>
                                    <?= Html::a( 'Excluir', ['delete','id' => $item->id],['class' => 'btn btn-danger']) ?>
                                    <?= Html::a( 'Histórico', ['historico','id' => $item->id],['class' => 'btn btn-info']) ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>


</div>
