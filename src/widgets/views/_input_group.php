<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $input string */
/* @var $buttonLabel string */
/* @var $buttonOptions array */
/* @var $modalId string */

?>

<div class="input-group">
    <?= $input ?>

    <span class="input-group-btn">
        <?= Html::button(
            "<span class='glyphicon glyphicon-folder-open' aria-hidden='true' style='margin-right: 5px'></span> {$buttonLabel}",
            array_merge($buttonOptions, ['data-toggle' => 'modal', 'data-target' => "#{$modalId}"])
        ) ?>
    </span>
</div>
