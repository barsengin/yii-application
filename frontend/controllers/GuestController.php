<?php

namespace frontend\controllers;

use common\models\Guest;
use Faker\Factory;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;

/**
 * Guest controller
 */
class GuestController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = Guest::class;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['show','index','create'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['show'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'show' => ['get'],
                    'index' => ['get'],
                    'create' => ['post','get'],
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $guest = Guest::find();
        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $guest->count(),
        ]);
        $guests = $guest->orderBy('username')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'guests' => $guests,
            'pagination' => $pagination
        ]);
    }

    public function actionView($id)
    {
        echo 'rtetr';
    }

    public function actionCreate()
    {
        $model = new  Guest();
        if (Yii::$app->request->post() || Yii::$app->request->isGet) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');

            $faker = Factory::create();
            $model->username = $faker->name;
            $model->email = $faker->email();
            $model->description = $faker->realText();
            $model->status = 10;
            $model->created_at = date('Y');
            $model->updated_at = date('Y');
            $model->insert();
            /*$db = Yii::$app->db;
            $outerTransaction = $db->beginTransaction();
            try {
                ;
                $db->createCommand()->insert('guest', [
                    'username' => $faker->name,
                    'email' => $faker->email(),
                    'description' => 'Çin çan çonlar sonuncu',
                    'status' => 10,
                    'created_at' => date('Y'),
                    'updated_at' => date('Y'),
                ])->execute();

                $outerTransaction->commit();
            } catch (\Exception $e) {
                $outerTransaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $outerTransaction->rollBack();
                throw $e;
            }*/
        }
        $this->redirect('/guest/index');
    }
}
