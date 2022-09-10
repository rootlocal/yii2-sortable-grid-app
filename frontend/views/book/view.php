<?php

use common\models\Book;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var Book $model
 */

$this->title = $model->name;
$this->params['breadcrumbs']['index'] = 'books';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="book-view-page">
    <h1 class="display-4"><?= $this->title ?></h1>

    <div class="book-view-content">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => fn(Book $model) => $model->getStatusItem($model->status),
                ],
                'created_at:datetime',
                'updated_at:datetime',
            ]]) ?>
    </div>


</div>


