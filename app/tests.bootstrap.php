<?php


// app/tests.bootstrap.php
if (isset($_ENV['BOOTSTRAP_CLEAR_CACHE_ENV'])) {
    // php bin/console cache:clear --env=test --no-warmup
    /*passthru(sprintf(
        'php "%s/console" cache:clear --env=%s --no-warmup',
        __DIR__.'/../bin',
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));*/

    // php bin/console h:d:f:l --no-interaction --env=test
    passthru('php bin/console doctrine:schema:drop --no-interaction --force --env=test');
    passthru('php bin/console doctrine:schema:create --no-interaction --env=test');
    passthru('php bin/console h:d:f:l --env=test --no-interaction ');
    passthru('php bin/console fos:user:promote bobo ROLE_ADMIN --env=test');
}

require __DIR__.'/autoload.php';