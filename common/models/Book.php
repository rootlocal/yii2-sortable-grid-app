<?php

namespace common\models;

use rootlocal\widgets\sortable\SortableGridBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $sort_order
 * @property int $created_at
 * @property int $updated_at
 *
 * @property-read string $url
 * @property-read array $statusItems
 *
 * @author Alexander Zakharov <sys@eml.ru>
 * @package common\models
 */
class Book extends ActiveRecord
{
    /** @var int */
    public const STATUS_TEST10 = 10;
    /** @var int */
    public const STATUS_TEST11 = 11;
    /** @var int */
    public const STATUS_TEST12 = 12;
    /** @var int */
    public const STATUS_TEST13 = 13;
    /** @var int */
    public const STATUS_TEST14 = 14;
    /** @var int */
    public const STATUS_TEST15 = 15;

    /** @var string|null */
    private ?string $_url = null;


    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%book}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'status'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => ['class' => TimestampBehavior::class],
            'sort' => ['class' => SortableGridBehavior::class],
        ];
    }

    /**
     * {@inheritdoc}
     * @return BookQuery the active query used by this AR class.
     */
    public static function find(): BookQuery
    {
        return new BookQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function getStatusItems(): array
    {
        return [
            self::STATUS_TEST10 => 'test 10',
            self::STATUS_TEST11 => 'test 11',
            self::STATUS_TEST12 => 'test 12',
            self::STATUS_TEST13 => 'test 13',
            self::STATUS_TEST14 => 'test 14',
            self::STATUS_TEST15 => 'test 15',
        ];
    }

    /**
     * @param int $item
     * @return string
     */
    public function getStatusItem(int $item): string
    {
        $items = $this->getStatusItems();

        return array_key_exists($item, $items) ? $items[$item] :
            Yii::t('app', 'Unknown status');
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        if ($this->_url === null) {
            $this->_url = Url::to(['/book/view', 'id' => $this->id]);
        }

        return $this->_url;
    }

}
