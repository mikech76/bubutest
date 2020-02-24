<?php

use yii\db\Migration;

/**
 * Class m200221_125048_create_table_region
 */
class m200221_125048_create_tables_4world extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Регионы
        $this->createTable('{{%regions}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string(255)->notNull()->unique(),
            'description' => $this->text(),
            'created_at'  => $this->timestamp(),
            'updated_at'  => $this->timestamp(),
        ]);

        // Страны

        $this->createTable('{{%countries}}', [
            'id'          => $this->primaryKey(),
            'region_id'   => $this->integer()->notNull(),
            'title'       => $this->string(255)->notNull()->unique(),
            'description' => $this->text(),
            'created_at'  => $this->timestamp(),
            'updated_at'  => $this->timestamp(),
        ]);

        $this->createIndex(
            'idx-countries-region_id',
            '{{%countries}}',
            'region_id',
            );

        $this->addForeignKey(
            'fk-countries-region_id',
            '{{%countries}}',
            'region_id',
            '{{%regions}}',
            'id',
            'CASCADE'
        );

        // Города
        $this->createTable('{{%cities}}', [
            'id'          => $this->primaryKey(),
            'country_id'  => $this->integer()->notNull(),
            'title'       => $this->string(255)->notNull()->unique(),
            'description' => $this->text(),
            'population' => $this->integer()->defaultValue(0),
            'created_at'  => $this->timestamp(),
            'updated_at'  => $this->timestamp(),
        ]);

        $this->createIndex(
            'idx-cities-country_id',
            '{{%cities}}',
            'country_id'
        );

        $this->addForeignKey(
            'fk-cities-country_id',
            '{{%cities}}',
            'country_id',
            '{{%countries}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cities}}');
        $this->dropTable('{{%countries}}');
        $this->dropTable('{{%regions}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200221_125048_create_table_region cannot be reverted.\n";

        return false;
    }
    */
}
