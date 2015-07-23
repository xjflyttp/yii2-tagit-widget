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
//work with ActiveForm
$form->field($model, 'tags')->widget(\xj\tagit\Tagit::className(), [
    'clientOptions' => [
        'tagSource' => Url::to(['tag/get-autocomplete']),
        'autocomplete' => [
            'delay' => 200,
            'minLength' => 1,
        ],
        'singleField' => true,
        'beforeTagAdded' => new JsExpression(<<<EOF
function(event, ui){
    if (!ui.duringInitialization) {
        console.log(event);
        console.log(ui);
    }
}
EOF
),
    ],
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

//auto render with autocomplete
echo Tagit::widget([
    'id' => 'myTagId3',
    'name' => 'mytag3',
    'clientOptions' => [
        'tagSource' => Url::to(['tag/get-autocomplete']),
        'autocomplete' => [
            'delay' => 0,
            'minLength' => 1,
        ],
    ]
]);
```

Assets
---
```php
xj\tagit\TagitAsset::register($this);
```