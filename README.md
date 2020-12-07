## プロジェクト概要

* 成瀬さんのドメイン駆動設計入門、結城さんのJava言語で学ぶデザインパターン入門を読んで得たことを実践する為の擬似的なプロジェクトです

## 環境構築

```
sh init.sh
sh start.sh

docker exec -it {Container ID} bash

composer install
```

## 初回構築以後

```
// 起動
sh start.sh

// 終了
sh stop.sh
```

## 導入内容

```
composer require slim/slim:"4.*"
composer require slim/psr7
composer require monolog/monolog

composer require phpunit/phpunit --dev
```

## 思想的な話

* 共通処理は親クラスに持たせたい。その際、親クラスは抽象クラスとし、命名はAbstract*.phpとする。抽象メソッドが無いとしても、インスタンス化させたくないクラスとなる為。
* インターフェースの命名は*Interface.phpとする。同一ディレクトリに置いたときに、インターフェースと実装したクラスのセットを見つけやすくする為。

## TODO

- [ ] app/container.php, app/routes.phpのスケール
- [ ] database何か見繕う
- [ ] monologの使用（ラップして使いやすくするもあり）