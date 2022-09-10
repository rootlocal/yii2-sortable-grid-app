<?php

use common\models\Book;
use yii\db\Migration;
use Faker\Factory;
use yii\helpers\Console;

/**
 * Class m220910_084120_generate_fake_data
 */
class m220910_084120_generate_fake_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Factory::create();

        try {
            $sort_order = 1;

            for ($i = 0; $i < 200; $i++) {
                $books = [];

                for ($j = 0; $j < 100; $j++) {
                    $books[] = [
                        $faker->text(rand(30, 40)), // name
                        rand(10, 15),               // status
                        $faker->unixTime(),         // created_at
                        $faker->unixTime(),         // updated_at
                        $sort_order,
                    ];

                    $sort_order = $sort_order + 10;
                }


                Yii::$app->db->createCommand()->batchInsert('{{%book}}', [
                    'name', 'status', 'created_at', 'updated_at', 'sort_order'
                ], $books)->execute();

                unset($books);
            }
        } catch (Exception|Throwable $e) {
            Console::output($e->getMessage());
        }


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
