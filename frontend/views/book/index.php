<?php

use common\models\BookSearch;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var BookSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="books-index-page">

    <h1 class="display-4"><?= $this->title ?></h1>

    <?php Pjax::begin([
        'id' => 'books-index-page-pjax',
        'scrollTo' => true,
    ]) ?>

    <?= $this->render('_grid', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]) ?>

    <?php Pjax::end() ?>

</div>