<?php

/* @var $this \yii\web\View */
/* @var $modalId string */
/* @var $modalTitle string */
/* @var $id string */

?>

<div class="modal fade" id="<?= $modalId ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= $modalTitle ?></h4>
            </div>
            <div class="modal-body">
                <div id="<?= $id ?>"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
