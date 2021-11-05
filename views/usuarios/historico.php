<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Usuário: '.$retorno->dados->usuario->nome.' '.$retorno->dados->usuario->sobrenome;
\yii\web\YiiAsset::register($this);
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a( 'Voltar', ['index'],['class' => 'btn btn-primary']) ?>
    <div class="container">
        <div class="row">
            <h4>Total de resultados encontratos: <?= count($retorno->dados->history); ?></h4>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Pesquisa</th>
                    <th>Quantidade</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($retorno->dados->history as $item): ?>
                    <tr>
                        <td width="60%">
                            <h3><?= str_replace('+',' ',$item->pesquisa) ?></h3>
                        </td>
                        <td>
                            <?= $item->quantidade ?>
                        </td>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
