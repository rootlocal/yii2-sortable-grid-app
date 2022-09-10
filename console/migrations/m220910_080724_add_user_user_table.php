<?php

use yii\db\Migration;
use yii\db\StaleObjectException;
use yii\helpers\Console;

/**
 * Class m220910_080724_add_user_user_table
 */
class m220910_080724_add_user_user_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $model = new \common\models\User();
        $model->username = 'admin';
        $model->email = 'admin@example.com';
        $model->setPassword('admin');
        $model->generateAuthKey();
        $model->save(false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $transaction = $this->getDb()->beginTransaction();

        try {
            $model = \common\models\User::findOne(['username' => 'admin']);

            if ($model !== null) {
                $model->delete();
                $transaction->commit();
            }

        } catch (StaleObjectException|Throwable $e) {
            $transaction->rollBack();
            Console::output(sprintf('error delete user: %s', $e->getMessage()));
        }
    }

}
