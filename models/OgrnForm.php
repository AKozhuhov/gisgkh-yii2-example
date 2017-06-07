<?php

namespace app\models;

use yii\base\Model;

class OgrnForm extends Model
{
    public $ogrn = null;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['ogrn', 'string', 'min' => 13, 'max' => 15],
            ['ogrn', 'required'],
            ['ogrn', 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ogrn' => 'ОГРН'
        ];
    }
}