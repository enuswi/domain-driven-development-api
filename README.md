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

* 親クラスはAbstract*.phpとする。抽象メソッドが無いとしても、インスタンス化させたくないクラスとなるので左記のようにする。


## TODO

- [ ] app/container.php, app/routes.phpのスケール
- [ ] database何か見繕う