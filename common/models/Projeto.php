<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projeto".
 *
 * @property int $id
 * @property string $num_processo
 * @property string $inicio_previsto
 * @property string $termino
 * @property string $nome_coordenador
 * @property string $edital
 * @property string $titulo_projeto
 * @property string $num_protocolo
 * @property double $cotacao_moeda_estrangeira
 * @property string $numero_fapeam_outorga
 * @property string $publicacao_diario_oficial
 *
 * @property Item[] $items
 * @property Receita[] $receitas
 * @property RelatorioPrestacao[] $relatorioPrestacaos
 * @property TermoAditivo[] $termoAditivos
 */
class Projeto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projeto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inicio_previsto', 'termino', 'publicacao_diario_oficial'], 'string'],
            [['cotacao_moeda_estrangeira'], 'number'],
            [['num_processo', 'num_protocolo'], 'string', 'max' => 100],
            [['nome_coordenador', 'edital', 'titulo_projeto', 'numero_fapeam_outorga'], 'string', 'max' => 200],
        ];
    }

    public function beforeSave($insert){
      if(parent::beforeSave($insert)){
        if($this->isNewRecord){
          if($this->inicio_previsto != NULL){
            $this->inicio_previsto = date("Y-m-d H:i:s", strtotime($this->inicio_previsto));
          }
          if($this->termino != NULL){
            $this->termino = date("Y-m-d H:i:s", strtotime($this->termino));
          }
          if($this->publicacao_diario_oficial != NULL){
            $this->publicacao_diario_oficial = date("Y-m-d H:i:s", strtotime($this->publicacao_diario_oficial));
          }
          return true;
        }else{
          return false;
        }
      }
    }

    public function afterFind(){
        if($this->inicio_previsto != NULL){
          $this->inicio_previsto = Yii::$app->formatter->asDate($this->inicio_previsto, 'd/M/Y');
        }
        if($this->termino != NULL){
          $this->termino = Yii::$app->formatter->asDate($this->termino, 'd/M/Y');
        }
        if($this->publicacao_diario_oficial != NULL){
          $this->publicacao_diario_oficial = Yii::$app->formatter->asDate($this->publicacao_diario_oficial, 'd/M/Y');
        }
        parent::afterFind();
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num_processo' => 'Número do Processo',
            'inicio_previsto' => 'Início Previsto',
            'termino' => 'Término',
            'nome_coordenador' => 'Nome do Coordenador',
            'edital' => 'Edital',
            'titulo_projeto' => 'Título do Projeto',
            'num_protocolo' => 'Número do Protocolo',
            'cotacao_moeda_estrangeira' => 'Cotação da Moeda Estrangeira',
            'numero_fapeam_outorga' => 'Número da FAPEAM',
            'publicacao_diario_oficial' => 'Publicação D.O',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id_projeto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceitas()
    {
        return $this->hasMany(Receita::className(), ['id_projeto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelatorioPrestacaos()
    {
        return $this->hasMany(RelatorioPrestacao::className(), ['id_projeto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTermoAditivos()
    {
        return $this->hasMany(TermoAditivo::className(), ['id_projeto' => 'id']);
    }
}
