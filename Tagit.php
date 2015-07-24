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
     * @var bool Render Html Tag
     */
    public $renderTag = true;

    /**
     *
     * @var [] tagit options
     * @see https://github.com/aehlke/tag-it/blob/master/README.markdown
     */
    public $clientOptions = [];


    public function init()
    {
        parent::init();

        if (false === isset($this->clientOptions['fieldName'])) {
            $this->clientOptions['fieldName'] = $this->isSingleField() ? $this->getInputName() : $this->getInputName() . '[]';
        }

        TagitAsset::register($this->getView());
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        if (true === $this->renderTag) {
            echo $this->renderWidget();
        }
        $this->registerScript();
    }

    /**
     * @return string the rendering result.
     */
    protected function renderWidget()
    {
        $inputName = $this->getInputName();
        $inputValue = $this->getInputValue();
        $tagId = $this->getId();

        $out = Html::beginTag('ul', ['id' => $tagId]);
        foreach ($inputValue as $value) {
            $out .= Html::tag('li', $value);
        }
        $out .= Html::endTag('ul');

        return $out;
    }

    private function isSingleField()
    {
        return isset($this->clientOptions['singleField']) ? (bool)($this->clientOptions['singleField']) : false;
    }

    private function getSingleFieldDelimiter()
    {
        return isset($this->clientOptions['singleFieldDelimiter']) ? $this->clientOptions['singleFieldDelimiter'] : ',';
    }

    /**
     * @return string
     */
    private function getInputName()
    {
        return $this->hasModel() ? Html::getInputName($this->model, $this->attribute) : $this->name;
    }

    /**
     * @return array
     */
    private function getInputValue()
    {
        if ($this->hasModel()) {
            if (false === empty($this->value)) {
                $inputValue = $this->value;
            } else {
                $attributeName = $this->attribute;
                $inputValue = $this->model->$attributeName;
            }
        } else {
            $inputValue = $this->value;
        }

        //filter
        $delimiter = $this->getSingleFieldDelimiter();
        $outputValue = [];
        if (empty($inputValue)) {
            //pass
        } elseif (is_string($inputValue)) {
            $outputValue = explode($delimiter, $inputValue);
        } elseif (is_array($inputValue)) {
            $outputValue = $inputValue;
        }
        return $outputValue;
    }

    protected function registerScript()
    {
        $id = $this->getId();
        $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
        $js = "jQuery('#{$id}').tagit({$options});";
        $this->getView()->registerJs($js);
    }

}
