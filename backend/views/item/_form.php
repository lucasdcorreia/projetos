<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskMoney;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'natureza')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'professor_responsavel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_item')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'justificativa')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'custo_unitario')->widget(\kartik\money\MaskMoney::class,['pluginOptions' => ['prefix' => 'R$', 'thousands' => '.', 'decimal' => ','] ]) ?>

    <?= $form->field($model, 'tipo_item')->hiddenInput(['tipo_item' => $tipo_item])->label(false); ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_projeto')->hiddenInput(['id_projeto' => $id_projeto])->label(false); ?>

    <div class="form-group" style="text-align: right">
        <?= Html::a('Cancelar','#',['class' => 'btn btn-default','onclick'=>"history.go(-1);"]); ?>
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
