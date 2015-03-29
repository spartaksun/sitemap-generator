<?php

/**
 * Binding dependencies
 */

\Yii::$container->set(
    \spartaksun\sitemap\generator\loader\LoaderInterface::class,
    \spartaksun\sitemap\generator\loader\GuzzleLoader::class
);

\Yii::$container->set(
    \spartaksun\sitemap\generator\parser\ParserInterface::class,
    \spartaksun\sitemap\generator\parser\HtmlParser::class
);

\Yii::$container->setSingleton(
    \spartaksun\sitemap\generator\storage\UniqueValueStorageInterface::class,
    [
        'class' => \spartaksun\sitemap\generator\storage\MysqlStorage::class,
        'db' => require("db.php"),
    ]
);
\Yii::$container->set(
    spartaksun\sitemap\generator\writer\WriterInterface::class,
    spartaksun\sitemap\generator\writer\XmlWriter::class
);