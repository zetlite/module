<?php

namespace Lite\Migration;

use Lite\Model\{BrandTable, ModelTable, ProductTable, PropertyTable};

class Demo
{
    static $data;
    /*я понимаю, что это такое себе*/
    private static function getData(): void
    {
        $brands = [
            "ASUS",
            "LENOVO",
            "APPLE",
        ];

        $models = [
            "ASUS" => [
                "TUF GAMING",
                "TUF DEFAULT",
                "TUF_L",
            ],
            "LENOVO" => [
                "GLADIATOR",
                "GAMIN",
                "LITE",
            ],
            "APPLE" => [
                "PRO 14",
                "PRO 16",
                "AIR",
            ],
        ];

        $products = [
            "ASUS" => [
                "TUF GAMING" => [
                    [
                        "NAME" => "TUF_GAMING_1",
                        "PRICE" => "1500",
                        "YEAR" => "2011",
                    ],
                    [
                        "NAME" => "TUF_GAMING_2",
                        "PRICE" => "1550",
                        "YEAR" => "2012",
                    ],
                    [
                        "NAME" => "TUF_GAMING_3",
                        "PRICE" => "1600",
                        "YEAR" => "2013",
                    ],
                ],
                "TUF DEFAULT" => [
                    [
                        "NAME" => "TUF DEFAULT 1",
                        "PRICE" => "3000",
                        "YEAR" => "2021",
                    ],
                    [
                        "NAME" => "TUF DEFAULT 2",
                        "PRICE" => "1500",
                        "YEAR" => "2010",
                    ],
                ],
                "TUF_L" => [
                    [
                        "NAME" => "TUF L 1",
                        "PRICE" => "800",
                        "YEAR" => "2015",
                    ],
                    [
                        "NAME" => "TUF L 2",
                        "PRICE" => "850",
                        "YEAR" => "2015",
                    ],
                ],
            ],
            "LENOVO" => [
                "GLADIATOR" => [
                    [
                        "NAME" => "GLADIATOR 2",
                        "PRICE" => "123",
                        "YEAR" => "2011",
                    ],
                    [
                        "NAME" => "GLADIATOR 1",
                        "PRICE" => "333",
                        "YEAR" => "2011",
                    ],
                    [
                        "NAME" => "GLADIATOR 3",
                        "PRICE" => "222",
                        "YEAR" => "2014",
                    ],
                    [
                        "NAME" => "GLADIATOR 4",
                        "PRICE" => "444",
                        "YEAR" => "2015",
                    ],
                ],
                "GAMIN" => [
                    [
                        "NAME" => "GAMIN",
                        "PRICE" => "7000",
                        "YEAR" => "2021",
                    ],
                    [
                        "NAME" => "GAMIN LTE",
                        "PRICE" => "5000",
                        "YEAR" => "2023",
                    ],
                ],
                "LITE" => [
                    [
                        "NAME" => "LITE QWE",
                        "PRICE" => "653",
                        "YEAR" => "2015",
                    ],
                ],
            ],
            "APPLE" => [
                "PRO 14" => [
                    [
                        "NAME" => "LEG_1",
                        "PRICE" => "123",
                        "YEAR" => "2017",
                    ],
                    [
                        "NAME" => "LEG_2",
                        "PRICE" => "123",
                        "YEAR" => "2017",
                    ],
                ],
                "PRO 16" => [
                    [
                        "NAME" => "QWE_2",
                        "PRICE" => "1234",
                        "YEAR" => "2021",
                    ],
                    [
                        "NAME" => "QWE_1",
                        "PRICE" => "1234",
                        "YEAR" => "2021",
                    ],
                    [
                        "NAME" => "QWE_3",
                        "PRICE" => "1234",
                        "YEAR" => "2021",
                    ],
                ],
                "AIR" => [
                    [
                        "NAME" => "LEG_98_UL",
                        "PRICE" => "777",
                        "YEAR" => "2019",
                    ],
                ],
            ],
        ];

        $options = [
            "WIFI",
            "AUX",
            "USB",
            "IPS",
            "ETHERNET",
            "TOUCHPAD",
        ];

        self::$data = [
            "BRANDS" => $brands,
            "MODELS" => $models,
            "PRODUCTS" => $products,
            "OPTIONS" => $options,
        ];
    }

    public static function installData()
    {
        self::getData();
        self::brands();
        self::models();
        self::products();
        self::options();
        self::addOptionsToProduct();
    }

    private static function brands(): void
    {
        foreach (self::$data["BRANDS"] as $brand) {
            BrandTable::add([
                "NAME" => $brand
            ]);
        }
    }

    private static function models(): void
    {
        foreach (self::$data["MODELS"] as $k => $model) {
            $idBrand = BrandTable::getList([
                "filter" => ["=NAME" => $k],
                "select" => ["ID"],
            ])->fetchObject();

            foreach ($model as $v) {
                ModelTable::add([
                    "NAME" => $v,
                    "BRAND_ID" => $idBrand->getId(),
                ]);
            }
        }
    }

    private static function products():void
    {
        foreach (self::$data["PRODUCTS"] as $k => $notebook) {
            foreach ($notebook as $k2 => $v2) {
                $model = ModelTable::getList([
                    "filter" => ["=NAME" => $k2],
                    "select" => ["ID"],
                ])->fetchObject();

                foreach ($v2 as $v1) {
                    ProductTable::add([
                        "NAME" => $v1["NAME"],
                        "PRICE" => $v1["PRICE"],
                        "YEAR" => $v1["YEAR"],
                        "MODEL_ID" => $model->getId(),
                    ]);
                }
            }
        }
    }

    private static function options(): void
    {
        foreach (self::$data["OPTIONS"] as $option) {
            PropertyTable::add([
                "NAME" => $option,
            ]);
        }
    }

    private static function addOptionsToProduct()
    {
        $properties = PropertyTable::getList()->fetchCollection();

        $products = ProductTable::getList()->fetchCollection();

        foreach ($products as $product) {
            $i = 0;
            $rand = rand(0, 5);
            foreach ($properties as $property) {
                if ($i > $rand) {
                    continue 2;
                }
                $product->addToProperty($property);
                $product->save();
                $i++;
            }
        }
    }
}