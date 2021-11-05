<?php

use yii\helpers\Html;
use yii\helpers\url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VideosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';

?>
<div class="videos-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if($dataProvider != null): ?>
        <div class="container">
            <div class="row">
                <h4>Total de resultados encontrados: <?= count($dataProvider->items); ?></h4>
                <table class="table table-striped table-bordered">
                    <?php foreach ($dataProvider->items as $item): ?>
                        <tr>
                            <td>

                                <?= Html::a(Html::img($item->snippet->thumbnails->high->url, ['style' => ['width' => '250px']]),Url::to(['/videos/view','id' => $item->id->videoId])); ?>
                            </td>
                            <td>
                                <div>
                                    <h3><?= $item->snippet->title ?></h3>
                                </div>
                                <div>
                                    <?= $item->snippet->description ?>
                                </div>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    <?php endif; ?>


</div>
