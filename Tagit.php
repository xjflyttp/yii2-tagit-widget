<?php

namespace xj\tagit;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * 
 * @author xjflyttp <xjflyttp@gmail.com>
 */
class Tagit extends InputWidget
{

    /**
     *
     * @var bool allow render input
     */
    public $renderInput = true;

    /**
     *
     * @var [] tagit options
     * @see https://github.com/aehlke/tag-it/blob/master/README.markdown
     */
    public $clientOptions = [];

    /**
     * Renders the widget.
     */
    public function run()
    {
        TagitAsset::register($this->getView());
        $this->registerScript();
        if (true === $this->renderInput) {
            echo $this->renderWidget();
        }
    }

    /**
     * @return string the rendering result.
     */
    protected function renderWidget()
    {
        if ($this->hasModel()) {
            return Html::activeHiddenInput($this->model, is_array($this->attribute) ? implode(',', $this->attribute) : $this->attribute, $this->options);
        } else {
            return Html::hiddenInput($this->name, is_array($this->value) ? implode(',', $this->value) : $this->value, $this->options);
        }
    }

    protected function registerScript()
    {
        $id = $this->options['id'];
        if ($this->clientOptions !== false) {
            $options = empty($this->clientOptions) ? '' : Json::htmlEncode($this->clientOptions);
            $js = "jQuery('#{$id}').tagit({$options});";
            $this->getView()->registerJs($js);
        }
    }

}
