<?php

namespace common\models;

use Yii;
use DateTime;

/**
 * This is the model class for table "termo_aditivo".
 *
 * @property int $id
 * @property string $numero_do_termo
 * @property string $motivo
 * @property string $vigencia
 * @property int $id_projeto
 *
 * @property Projeto $projeto
 */
class TermoAditivo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'termo_aditivo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['motivo'], 'string'],
            [['vigencia'], 'date', 'format' => 'dd/mm/yyyy'],
            [['id_projeto'], 'integer'],
            [['numero_do_termo'], 'string', 'max' => 50],
            [['id_projeto'], 'exist', 'skipOnError' => true, 'targetClass' => Projeto::className(), 'targetAttribute' => ['id_projeto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero_do_termo' => 'Número de Termo',
            'motivo' => 'Motivo',
            'vigencia' => 'Vigência',
            'id_projeto' => 'Projeto',
        ];
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
          if($this->isNewRecord){
          //if($this->isNewRecord){
            if($this->vigencia != NULL){
              $myDateTime = DateTime::createFromFormat('d/m/Y', $this->vigencia);
              $this->vigencia = $myDateTime->format('Y-m-d 00:00:00');
            }
            return true;
          }else{
            return false;
          }
        }
    }

    public function afterFind(){
        if($this->vigencia != NULL){
          $myDateTime = DateTime::createFromFormat('Y-m-d H:i:00', $this->vigencia);
          $this->vigencia = $myDateTime->format('d/m/Y');
        }
        parent::afterFind();
        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjeto()
    {
        return $this->hasOne(Projeto::className(), ['id' => 'id_projeto']);
    }
}
