<?php

use yii\db\Migration;
use common\models\world\Region;
use common\models\world\Country;
use common\models\world\City;

/**
 * Class m200221_184654_data2world
 */
class m200221_184654_data2world extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $file = file(__DIR__ . '/data-world.csv');
        foreach ($file as $item) {
            [$region, $country, $city, $population] = explode(';', $item);

            if ( !$re = Region::findOne(['title' => $region])) {
                $re        = new Region();
                $re->title = $region;
                $re->save();
            };

            if ( !$co = Country::findOne(['title' => $country])) {
                $co            = new Country();
                $co->region_id = $re->id;
                $co->title     = $country;
                $co->save();
            };

            if ( !$ci = City::findOne(['title' => $city])) {
                $ci             = new City();
                $ci->population = (int)$population;
                $ci->country_id = $co->id;
                $ci->title      = $city;
                $ci->save();
            };
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //  echo "m200221_184654_data2world cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200221_184654_data2world cannot be reverted.\n";

        return false;
    }
    */

}
