<?php

namespace backend\controllers;

use common\models\Guest;
use common\models\LoginForm;
use Yii;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class GuestController extends Controller
{
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
                        'actions' => ['index', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['create', 'index'],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return
     */
    public function actionIndex()
    {
        $guest = Guest::find();
        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $guest->count(),
        ]);
        return $guest->orderBy('username')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        /*if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }*/

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        //$model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
