<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Videos */

?>
<div class="videos-view container-fluid">

    <h3><?= Html::a( 'Voltar', Yii::$app->request->referrer,['class' => 'btn btn-primary']) ?> VIsualização</h3>

    <iframe width="1100" height="600" src="https://www.youtube.com/embed/<?= $video ?>"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>

    </iframe>

</div>
