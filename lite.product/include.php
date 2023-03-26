<?php

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
    'lite.product',
    [
        /* Models */
        'Lite\Model\BrandTable' => "lib/models/BrandTable.php",
        'Lite\Model\ModelTable' => "lib/models/ModelTable.php",
        'Lite\Model\ProductTable' => "lib/models/ProductTable.php",
        'Lite\Model\PropertyTable' => "lib/models/PropertyTable.php",
        'Lite\Model\ProductPropTable' => "lib/models/ProductPropTable.php",

        /* Demo Content */
        'Lite\Migration\Demo' => "lib/migration/Demo.php",
        'Lite\Migration\Storage' => "lib/migration/Storage.php",
    ]
);