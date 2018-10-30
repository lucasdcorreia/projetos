<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RelatorioPrestacao */

$this->title = 'Update Relatorio Prestacao: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Relatorio Prestacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="relatorio-prestacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
