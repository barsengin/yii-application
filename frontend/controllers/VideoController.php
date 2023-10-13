<?php

namespace frontend\controllers;

use common\models\Guest;
use common\models\GuestSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\grid\GridView;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\widgets\ListView;

/**
 * User controller
 */
class VideoController extends Controller
{
    public string $modelClass = Guest::class;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new GuestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        //var_dump((new Query())->from('guest'));
        $dataProvider =  new ActiveDataProvider([
            'query' => Guest::find(),
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
            ],
        ]);
        /*echo GridView::widget([
            'dataProvider' => $dataProvider,
        ]);*/
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
        //exit();
        //return $provider->getModels();
        //var_dump($provider->totalCount); exit();
    }
    
    public function actionView($id)
    {
        echo 'rtetr';
    }
}
