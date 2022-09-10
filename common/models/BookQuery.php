<?php

namespace common\models;

use rootlocal\widgets\sortable\SortableGridQueryTrait;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Book]].
 *
 * @see Book
 * @mixin SortableGridQueryTrait
 */
class BookQuery extends ActiveQuery
{
    use SortableGridQueryTrait;

    /**
     * {@inheritdoc}
     * @return Book[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Book|array|null
     */
    public function one($db = null): Book|array|null
    {
        return parent::one($db);
    }
}
