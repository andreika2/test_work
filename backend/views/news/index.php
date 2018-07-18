<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return '<div class="col-md-5">' .
            '<div class="panel panel-default">'.
            Html::img(Yii::getAlias('@web') . '/uploads/' . $model->image_url,['widht'=>'200px' ,'height' => '200px']) . '<br>' .  
            Html::a(Html::encode($model->title), ['view', 'id' => $model->id]) .
            '<br><i>' . $model->preview . '</i>' .
            '<br><i>' . $model->date_create . '</i>'
            .'</div>'
            .'</div>';
        },
    ]) ?>
</div>
