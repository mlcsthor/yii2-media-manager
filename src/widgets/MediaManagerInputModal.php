<?php

namespace mlcsthor\mediamanager\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

use mlcsthor\mediamanager\widgets\MediaManagerAsset;

class MediaManagerInputModal extends \yii\widgets\InputWidget {
    /**
     * @var string
     */
    public $modalTitle = 'Media Manager';

    /**
     * @var string
     */
    public $inputId;

    /**
     * @var array
     */
    public $inputOptions = ['class' => 'form-control'];

    /**
     * @var string
     */
    public $buttonLabel = 'Browse';

    /**
     * @var array
     */
    public $buttonOptions = ['class' => 'btn btn-primary'];

    /**
     * MM options
     * @var array
     */
    public $clientOptions = [];

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function init() {
        parent::init();

        if ($this->hasModel()) {
            $this->inputId = Html::getInputId($this->model, $this->attribute);
        } else {
            $this->inputId = $this->getId() . '-input';
            $this->inputOptions = array_merge($this->inputOptions, [
                'id' => $this->inputId,
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function run() {
        echo $this->renderInputGroup();
        echo $this->renderModal();
        $this->registerClientScript();
    }

    /**
     * @return string
     */
    public function renderInput() {
        if ($this->hasModel()) {
            return $this->render('_active_input', ['model' => $this->model, 'attribute' => $this->attribute, 'options' => $this->inputOptions]);
        } else {
            return $this->render('_input', ['name' => $this->name, 'value' => $this->value, 'options' => $this->inputOptions]);
        }
    }

    /**
     * @return string
     */
    public function renderInputGroup() {
        return $this->render('_input_group', [
            'input' => $this->renderInput(),
            'buttonLabel' => $this->buttonLabel,
            'buttonOptions' => $this->buttonOptions,
            'modalId' => $this->getModalId()
        ]);
    }

    /**
     * @return string
     */
    public function renderModal() {
        return $this->render('_modal', ['modalId' => $this->getModalId(), 'id' => $this->getId(), 'modalTitle' => $this->modalTitle]);
    }

    /**
     * @return string
     */
    public function getModalId() {
        return $this->getId() . '-modal';
    }
    /**
     * Register js
     */
    public function registerClientScript() {
        $view = $this->getView();
        MediaManagerAsset::register($view);

        $options = array_merge($this->clientOptions, [
            'el' => '#' . $this->getId(),
            'input' => [
                'el' => '#' . $this->inputId,
                'multiple' => false,
            ],
            'onSelect' => new JsExpression("function(e) { $('#{$this->getModalId()}').modal('hide'); }"),
        ]);

        $varName = str_replace('-', '_', $this->getId());
        $options = Json::encode($options);
        $js = <<<JS
            var {$varName};
            $('#{$this->getModalId()}')
                .on('show.bs.modal', function (e) {
                    {$varName} = new MM({$options});
                }).on('hide.bs.modal', function (e) {
                    {$varName}.destroy();
                });
JS;
        $view->registerJs($js, \yii\web\View::POS_END);
    }

}
