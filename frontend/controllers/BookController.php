<?php

namespace frontend\controllers;

use common\models\Book;
use common\models\BookSearch;
use rootlocal\widgets\sortable\SortableGridAction;
use Throwable;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class BookController
 *
 * @author Alexander Zakharov <sys@eml.ru>
 * @package frontend\controllers
 */
final class BookController extends Controller
{


    /**
     * {@inheritDoc}
     */
    public function actions(): array
    {
        return [
            'sort' => [
                'class' => SortableGridAction::class,
                'model' => Book::class,
            ]

        ];
    }

    /**
     * @return string
     */
    public final function actionIndex(): string
    {
        $searchModel = new BookSearch();
        $searchModel->query = $searchModel->getQuery()->sortByOrder();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        if (Yii::$app->request->isAjax || Yii::$app->request->isPjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public final function actionView(int $id): string
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax || Yii::$app->request->isPjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $this->renderAjax('view', ['model' => $model]);
        }

        return $this->render('view', ['model' => $model]);
    }

    /**
     * @param int $id
     * @return bool[]|false[]|Response
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws Throwable
     */
    public final function actionDelete(int $id)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }

        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Entry deleted'));
            return Yii::$app->request->isAjax ? ['success' => true] : $this->redirect(['/book/index']);
        }

        Yii::$app->session->setFlash('error', Yii::t('app', 'Could not delete Entry'));
        return Yii::$app->request->isAjax ? ['success' => false] : $this->redirect(['/book/index']);
    }

    /**
     * @param int $id
     * @return Book
     * @throws NotFoundHttpException
     */
    private function findModel(int $id): Book
    {
        $model = Book::findOne($id);

        if ($model === null) {
            throw new NotFoundHttpException(Yii::t('app', 'Page Not Found'));
        }

        return $model;
    }
}