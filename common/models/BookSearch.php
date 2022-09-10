<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\data\Sort;

/**
 * Class BookSearch
 *
 * @property-read Sort $sort
 * @property-read Pagination $pagination
 * @property int $pageSize
 * @property BookQuery $query
 *
 * @author Alexander Zakharov <sys@eml.ru>
 * @package common\models
 */
class BookSearch extends Book
{
    /** @var null|BookQuery */
    private ?BookQuery $_query = null;
    /** @var null|ActiveDataProvider */
    private ?ActiveDataProvider $_dataProvider = null;
    /** @var Sort|null */
    private ?Sort $_sort = null;
    /** @var null|Pagination */
    private ?Pagination $_pagination = null;
    /** @var int */
    private int $_pageSize = 50;


    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'status'], 'integer'],
            ['name', 'string'],
            [['created_at', 'updated_at'], 'date'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function scenarios(): array
    {
        return Model::scenarios();
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params = []): ActiveDataProvider
    {
        $query = $this->getQuery();
        $dataProvider = $this->getDataProvider($query);
        $dataProvider->sort = $this->getSort();
        $dataProvider->pagination = $this->getPagination();
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if (!empty($this->name)) {
            $query->andFilterWhere(['like', self::tableName() . '.name', $this->name]);
        }

        if (!empty($this->status)) {
            $query->andWhere([self::tableName() . '.status' => $this->status]);
        }

        if (!empty($this->created_at)) {
            $start = strtotime($this->created_at . ' 00:00:01');
            $stop = strtotime($this->created_at . ' 23:59:59');

            if ($start !== false) {
                $query->andFilterWhere(['>=', self::tableName() . '.created_at', $start]);
            }

            if ($stop !== false) {
                $query->andFilterWhere(['<=', self::tableName() . '.created_at', $stop]);
            }
        }

        if (!empty($this->updated_at)) {
            $start = strtotime($this->updated_at . ' 00:00:01');
            $stop = strtotime($this->updated_at . ' 23:59:59');

            if ($start !== false) {
                $query->andFilterWhere(['>=', self::tableName() . '.updated_at', $start]);
            }

            if ($stop !== false) {
                $query->andFilterWhere(['<=', self::tableName() . '.updated_at', $stop]);
            }
        }

        return $dataProvider;
    }

    /**
     * @return BookQuery
     */
    public function getQuery(): BookQuery
    {
        if ($this->_query === null) {
            $this->_query = self::find();
        }

        return $this->_query;
    }

    /**
     * @param BookQuery $query
     */
    public function setQuery(BookQuery $query): void
    {
        $this->_query = $query;
    }

    /**
     * @param BookQuery|null $query
     * @return ActiveDataProvider
     */
    public function getDataProvider(?BookQuery $query = null): ActiveDataProvider
    {
        if ($query === null) {
            $query = $this->getQuery();
        }

        if ($this->_dataProvider === null) {
            $this->_dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }

        return $this->_dataProvider;
    }

    /**
     * @return Sort
     */
    public function getSort(): Sort
    {
        if ($this->_sort === null) {
            $this->_sort = new Sort([
                'defaultOrder' => ['sort_order' => SORT_ASC],
                'attributes' => [

                    'id' => [
                        'asc' => [self::tableName() . '.id' => SORT_ASC],
                        'desc' => [self::tableName() . '.id' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],

                    'name' => [
                        'asc' => [self::tableName() . '.name' => SORT_ASC],
                        'desc' => [self::tableName() . '.name' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],

                    'sort_order' => [
                        'asc' => [self::tableName() . '.sort_order' => SORT_ASC],
                        'desc' => [self::tableName() . '.sort_order' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],

                    'status' => [
                        'asc' => [self::tableName() . '.status' => SORT_ASC],
                        'desc' => [self::tableName() . '.status' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],

                    'created_at' => [
                        'asc' => [self::tableName() . '.created_at' => SORT_ASC],
                        'desc' => [self::tableName() . '.created_at' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],

                    'updated_at' => [
                        'asc' => [self::tableName() . '.updated_at' => SORT_ASC],
                        'desc' => [self::tableName() . '.updated_at' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],

                ]
            ]);
        }

        return $this->_sort;
    }

    /**
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        if ($this->_pagination === null) {
            $this->_pagination = new Pagination([
                'pageSize' => $this->getPageSize(),
                'defaultPageSize' => $this->getPageSize(),
                'forcePageParam' => false,
            ]);
        }

        return $this->_pagination;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->_pageSize;
    }

    /**
     * @param int $pageSize
     */
    public function setPageSize(int $pageSize): void
    {
        $this->_pageSize = $pageSize;
    }


}