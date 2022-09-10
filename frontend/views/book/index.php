<?php

use a1inani\yii2ModalAjax\ModalAjax;
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

<?= ModalAjax::widget([
    'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_5,
    'selector' => 'a.book-grid-modal',
    'options' => ['class' => 'header-primary'],
    'pjaxContainer' => '#book-grid-pjax',
    'autoClose' => true,
]); ?>

<div class="books-index-page">

    <h1 class="display-4"><?= $this->title ?></h1>

    <?php Pjax::begin([
        'id' => 'book-grid-pjax',
        'scrollTo' => true,
    ]) ?>

    <?= $this->render('_grid', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]) ?>

    <?php Pjax::end() ?>

</div>