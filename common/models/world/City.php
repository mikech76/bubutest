<?php

namespace common\models\world;

use Yii;
use yii\db\ActiveRecord;
use common\models\world\Country;

/**
 * This is the model class for table "cities".
 *
 * @property int         $id
 * @property int         $country_id
 * @property string      $title
 * @property integer     $population
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cities}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'country_id'], 'required'],
            [['description'], 'string'],
            [['country_id', 'population'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'country_id'   => 'Страна',
            'title'        => 'Город / Агломерация',
            'description'  => 'Description',
            'population'   => 'Население агломирации (т.ч.)',
            'created_at'   => 'Created At',
            'updated_at'   => 'Updated At',
            'countryTitle' => 'Страна',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value'      => new \yii\db\Expression('NOW()'),
            ],
        ];
    }
}
