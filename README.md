# yii2-tagit-widget
```
https://github.com/aehlke/tag-it
```

composer.json
---------
```json
"require": {
    "xj/yii2-tagit-widget": "*"
},
```

In View
---------
```php
xj\tagit\TagitAsset::register($this);

//work with ActiveForm
$form->field($model, 'tags')->widget(\xj\tagit\Tagit::className(), [
    'clientOptions' => [
        'availableTags' => ['aaa', 'bbb']
        //....
    ]
]);

//work with hidden input
echo yii\helpers\Html::hiddenInput('mytag', '', ['id' => 'myTagId']);
echo Tagit::widget([
    'renderInput' => false,
    'id' => 'myTagId',
    'name' => 'mytag',
    'value' => ['a', 'b'],
    'clientOptions' => [
        'availableTags' => ['aaa', 'bbb']
    ]
]);

//work with hidden input (input init value)
echo yii\helpers\Html::hiddenInput('mytag2', 'a,b,c,d', ['id' => 'myTagId2']);
echo Tagit::widget([
    'renderInput' => false,
    'id' => 'myTagId2',
    'name' => 'mytag2',
    'clientOptions' => [
        'availableTags' => ['aaa', 'bbb']
    ]
]);

//auto render
echo Tagit::widget([
    'id' => 'myTagId3',
    'name' => 'mytag3',
    'clientOptions' => [
        'availableTags' => ['aaa', 'bbb']
    ]
]);
```
