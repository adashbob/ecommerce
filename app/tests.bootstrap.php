<?php


// app/tests.bootstrap.php
if (isset($_ENV['BOOTSTRAP_CLEAR_CACHE_ENV'])) {
    // php bin/console cache:clear --env=test --no-warmup
    passthru(sprintf(
        'php "%s/console" cache:clear --env=%s --no-warmup',
        __DIR__.'/../bin',
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));


    // php bin/console doctrine:fixtures:load --no-interaction --em=test
    passthru('php bin/console doctrine:fixtures:load --em=test --no-interaction --em=test');
}

require __DIR__.'/autoload.php';