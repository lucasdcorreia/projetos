<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Arquivo */

$this->title = "Arquivo";
$this->params['breadcrumbs'][] = ['label' => 'Arquivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="arquivo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php function existeArquivo($model){
      $path = \Yii::getAlias('@backend/../uploads/projetos/arquivo/');

      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . '_' . $model->id_projeto . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if(file_exists($file)) {
          return true;
        }else{
          return false;
        }
      }
    }?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'id_projeto',
            'nome',
            'tipo',
            [
              'attribute' => 'Anexo',
              'label' => 'Anexo',
              'format' => 'raw',
              'value' => function($model){
                return ( existeArquivo($model) ? '  ' . Html::a( 'Baixar Anexo' . ' <i class="fas fa-paperclip" ></i>', ['/arquivo/download', 'id' => $model->id] ) . Html::a(existeArquivo($model) ? '| <i class="fa fa-close" ></i> Excluir anexo' : '', ['/arquivo/deleteanexo', 'id' => $model->id] ) : '');
              },
            ],
        ],
    ]) ?>

</div>
