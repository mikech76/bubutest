<?php

namespace common\models\world;

use Yii;
use yii\db\ActiveRecord;
use common\models\world\Country;
use common\models\world\City;

/**
 * This is the model class for table "regions".
 *
 * @property int         $id
 * @property string      $title
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
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
            'id'          => 'ID',
            'title'       => 'Title',
            'description' => 'Description',
            'created_at'  => 'Created At',
            'updated_at'  => 'Updated At',
            'find'        => 'Поиск',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Country::class, ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return City::find()
                   ->leftJoin('countries', 'cities.country_id = countries.id')
                   ->where(['countries.region_id' => $this->id]);
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
