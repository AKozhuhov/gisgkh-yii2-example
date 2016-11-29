<p>
    <a class="btn btn-default" href="#" onclick="$('.i-code-example').toggle()">Посмотреть исходный код с комментариями</a>
</p>

<div class="i-code-example" style="display: none;">

    <p>
        Модуль OpenGKH предоставляет два способа работы со справочниками:
        <ol>
            <li>единый интерфейс справочника с динаимческой структурой записей</li>
            <li>отдельные классы для каждого справочника</li>
        </ol>
        В данном примере используется первый вариант. При таком подходе, для работы с НСИ в приложении нужно реализовать
        три класса, реализующие <a href="https://github.com/opengkh/yii2-gisgkh/tree/master/interfaces/nsi/DynamicReference">интерфейсы DynamicReference</a>:
        <code>IDynamicElement</code>, <code>IDynamicReference</code> и <code>IDynamicReferenceManager</code>. Интерфейсы
        не накладывают ограничений на внутреннюю реализацию механизма хранения справочников в приложении. В данном примере
        интефейсы реализованы в <a href="https://github.com/opengkh/yii2-gisgkh-example/tree/master/app/nsi">директории app/nsi</a>.
    </p>

    <p>
        В конфигурации приложения можно подключить в качестве компонента класс, реализующий <code>IDynamicReferenceManager</code>
        и указать его в настройках модуля <code>yii2-open-gkh</code>.

        <pre>
'components' => [
    ...
    'nsiStorage' => [
        'class' => 'app\nsi\NSIStorage'
    ],
],
'modules' => [
    ...
    'gisgkh' => [
        ...
        'nsiManager' => 'nsiStorage'
    ]
]
        </pre>
    </p>
    <p>
        После такого подключения будет доступен компонент
        <a href="https://github.com/opengkh/yii2-gisgkh/blob/master/interfaces/nsi/DynamicReference/IDynamicReferenceManager.php"><code>\Yii::$app->nsi</code></a>,
        предоставляющий методы для актуализации сведений НСИ в приложении.
    </p>
    <p>

        Код котроллера, получающего перечень справочников:

        <pre>
/**
 * @var NsiDynamicManager $nsi
 */
$nsi = \Yii::$app->get('nsi');
$nsi->updateReferencesList();

/**
 * @var NSIStorage $nsiStorage
 */
$nsiStorage = \Yii::$app->get('nsiStorage');

$dataProvider = new ArrayDataProvider([
    'allModels' => $nsiStorage->references
]);

return $this->render('index', [
    'dataProvider' => $dataProvider
]);
        </pre>
    </p>

    <p>
        Код контроллера, выводящий содержимое справочника:

        <pre>
/**
 * @var NsiDynamicManager $nsi
 */
$nsi = \Yii::$app->get('nsi');
$nsi->updateReferencesList();
$nsi->updateReference($registryNumber);

/**
 * @var NSIStorage $nsiStorage
 */
$nsiStorage = \Yii::$app->get('nsiStorage');

$firstElement = array_values($nsiStorage->references[$registryNumber]->elements)[0];
$columns = [[
    'label' => 'Код',
    'headerOptions' => [
        'width' => '5rem'
    ],
    'format' => 'raw',
    'value' => function (NSIElement $element) {
        return $element->code;
    }
]];

if (!empty($firstElement)) {
    foreach ($firstElement->fields as $template) {
        $columns[] = [
            'label' => $template->Name,
            'format' => 'raw',
            'value' => function (NSIElement $element) use ($template) {
                switch ($template::className()) {
                    case NsiElementStringFieldType::className():
                        /* @var NsiElementStringFieldType $field */
                        $field = $element->fields[$template->Name];
                        return $field->Value;
                        break;
                    case NsiElementBooleanFieldType::className():
                        /* @var NsiElementBooleanFieldType $field */
                        $field = $element->fields[$template->Name];
                        return $field->Value ? 'да' : 'нет';
                        break;
                    case NsiElementFloatFieldType::className():
                        /* @var NsiElementFloatFieldType $field */
                        $field = $element->fields[$template->Name];
                        return sprintf("%d", $field->Value);
                        break;
                    case NsiElementOkeiRefFieldType::className():
                        /* @var NsiElementOkeiRefFieldType $field */
                        $field = $element->fields[$template->Name];
                        $okei = Okei::getByCode($field->Code);
                        return $okei ? $okei->title : $field->Code;
                        break;
                    default:
                        $field = $element->fields[$template->Name];
                        return json_encode($field, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
            }
        ];
    }
}

$dataProvider = new ArrayDataProvider([
    'allModels' => $nsiStorage->references[$registryNumber]->elements,
]);


return $this->render('view', [
    'reference' => @$nsiStorage->references[$registryNumber],
    'dataProvider' => $dataProvider,
    'columns' => $columns
]);
        </pre>
    </p>
</div>
