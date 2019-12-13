<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_datatran".
 *
 * @property int $id_data
 * @property string $tanggl
 * @property int $jumlah
 */
class Prediksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_datatran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hari','tanggl', 'jumlah'], 'required'],
            [['tanggl'], 'safe'],
            [['jumlah'], 'integer'],
        ];
    }

    public function datatanggal()
    {
        return [
            3 => ' harike 3',
            4 => ' harike 4',
            5 => ' harike 5',
            6 => ' harike 6',
            7 => ' harike 7',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_data' => 'Id Data',
            'tanggl' => 'Tanggl',
            'jumlah' => 'Jumlah',
        ];
    }
}
