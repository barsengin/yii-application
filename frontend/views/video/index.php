<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\grid\GridView;

$this->title = 'Guest';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" >
                    <h1><?= Html::encode($this->title) ?></h1>
                    <h1><?=
                        GridView::widget([
                            'tableOptions' => [
                                'class' => 'table table-striped',
                            ],
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\ActionColumn'],
                                'username',
                                'email',
                                'status',
                                [
                                    'label' => 'Education',
                                    'attribute' => 'status',
                                    'filter' => ['10' => 'Active', '9' => 'Passive'],
                                    'filterInputOptions' => ['prompt' => 'All status', 'class' => 'form-control', 'id' => null]
                                ],
                            ],
                            'options' => [
                                'class' => 'table-responsive',
                                'style' => [
                                    'style="max-height' => '100vh'
                                ]
                            ],
                            'dataProvider' => $dataProvider
                        ]);
                        ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>

