<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\LinkPager;
use yii\captcha\Captcha;

$this->title = 'Guest';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>
    <div class="row">
        <div class="col-lg-12">
            <?php foreach ($guests as $guest): ?>
                <li>
                    <?= Html::encode("{$guest->username}") ?>:
                    <?= $guest->email ?>
                    <?= $guest->description ?>
                </li>
            <?php endforeach; ?>

            <?= LinkPager::widget([
                'pagination' => $pagination,
                'prevPageCssClass' => 'p-back',
                'nextPageCssClass' => 'p-next',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['action' => 'guest/create', 'id' => 'contact-form']); ?>

            <div class="form-group">
                <?= Html::submitButton('Submit New Guest', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
