<?php

use common\models\BookSearch;
use kartik\date\DatePicker;
use rootlocal\widgets\sortable\SortableGridColumnWidget;
use yii\bootstrap5\Html;
use yii\bootstrap5\LinkPager;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\View;

/**
 * @var View $this
 * @var BookSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */
?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layout' => $this->render('_grid_layout'),

    'pager' => [
        'class' => LinkPager::class,
        'options' => [
            'class' => 'book-index-pager',
        ]
    ],

    'columns' => [

        [
            'class' => SortableGridColumnWidget::class,
        ],

        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function (BookSearch $model) {
                $name = sprintf('%d. %s', $model->id, $model->name);
                return Html::a($name, $model->getUrl(), [
                    'class' => 'grid-book-name link book-grid-modal',
                    //'data' => ['pjax' => 1],
                ]);
            }
        ],

        [
            'attribute' => 'status',
            'format' => 'raw',
            'filter' => $searchModel->getStatusItems(),
            'value' => fn(BookSearch $model) => $model->getStatusItem($model->status),
        ],

        [
            'attribute' => 'created_at',
            'format' => 'datetime',
            'headerOptions' => [
                'style' => 'width: 210px;  min-width:210px;',
                'class' => 'text-center',
            ],
            'filter' => DatePicker::widget([
                'bsVersion' => '5.x',
                'model' => $searchModel,
                'attribute' => 'created_at',
                'value' => date('d-M-Y', strtotime('+2 days')),

                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Select date',
                    'autocomplete' => 'off',
                ],
                'language' => 'ru',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'removeIcon' => '<i class="fa fa-trash text-primary"></i>',
                'pluginOptions' => [
                    'calendarWeeks' => true,
                    'autoclose' => true,
                    'todayBtn' => false,
                    'format' => 'dd.mm.yyyy',
                    'todayHighlight' => true
                ],
            ]),
        ],


        [
            'attribute' => 'updated_at',
            'format' => 'datetime',
            'headerOptions' => [
                'style' => 'width: 210px;  min-width:210px;',
                'class' => 'text-center',
            ],
            'filter' => DatePicker::widget([
                'bsVersion' => '5.x',
                'model' => $searchModel,
                'attribute' => 'updated_at',
                'value' => date('d-M-Y', strtotime('+2 days')),

                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Select date',
                    'autocomplete' => 'off',
                ],
                'language' => 'ru',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'removeIcon' => '<i class="fa fa-trash text-primary"></i>',
                'pluginOptions' => [
                    'calendarWeeks' => true,
                    'autoclose' => true,
                    'todayBtn' => false,
                    'format' => 'dd.mm.yyyy',
                    'todayHighlight' => true
                ],
            ]),
        ],

        [
            'class' => ActionColumn::class,
            'template' => '{delete}',
            'buttons' => [
                'update' => function (string $url, BookSearch $model) {

                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'class' => 'link book-grid-modal',
                        'id' => 'update-book-link-' . $model->id,
                        'data-pjax' => 0,
                        'title' => Yii::t('app', 'Update {name}', ['name' => $model->name()]),]);
                }
            ],

        ],

    ],

]) ?>

