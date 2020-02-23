<?php

namespace frontend\controllers;

use common\models\world\CitySearch;
use Yii;
use common\models\world\Region;
use common\models\world\RegionSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegionController implements the CRUD actions for Region model.
 */
class RegionController extends Controller
{
    /**
     * Lists all Region models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new RegionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchCity = new CitySearch();
        $searchCity->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'searchCity'   => $searchCity,
        ]);
    }

    /**
     * Displays a single Region model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Region model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Region the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Region::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ];
    }

}
