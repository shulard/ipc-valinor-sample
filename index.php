<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Model\Contract;

$input = <<<JSON
{
    "starts_at": "2022-01-01 00:00:00",
    "expires_at": "2022-12-31 00:00:00",
    "author": {
        "name": "Neslon Mandela",
        "email": "nelson.mandela@mail.com"
    }
}
JSON;

try {
    $contract = (new \CuyZ\Valinor\MapperBuilder())
        ->mapper()
        ->map(
            Contract::class,
            \CuyZ\Valinor\Mapper\Source\Source::iterable(
                new \CuyZ\Valinor\Mapper\Source\JsonSource($input)
            )->camelCaseKeys()
        );

    var_dump($contract);
} catch (\CuyZ\Valinor\Mapper\MappingError $error) {
    // Get flatten list of all messages through the whole nodes tree
    $node = $error->node();
    $messages = new \CuyZ\Valinor\Mapper\Tree\Message\MessagesFlattener($node);

    // If only errors are wanted, they can be filtered
    $errorsMessages = $messages->errors();

    foreach ($errorsMessages as $key => $message) {
        echo sprintf(
            '%s => %s'.PHP_EOL,
            $message->path(),
            $message->body()
        );
    }
}
