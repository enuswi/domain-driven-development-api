<?php
/**
 * DIコンテナ設定
 * @var \DI\Container $container
 */

/**
 * Chara
 */
$container->set('CharaRepository', function () {
    //return new \app\Repositories\CharaRepository();
    return new \app\Repositories\MockCharaRepository();
});