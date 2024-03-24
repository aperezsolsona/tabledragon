<?php

declare(strict_types=1);

namespace TableDragon\Infrastructure\Shared;

use Exception;

class Uuid
{
    public function makeUuid(): string
    {
        // Check if the ext-uuid extension is loaded
        if (extension_loaded('uuid')) {
            // Generate a UUID version 4 (random UUID)
            $uuid = uuid_create(UUID_TYPE_RANDOM);
            // Convert the binary UUID to a string representation
            $uuidString = uuid_to_str($uuid);

            return $uuidString;
        } else {
            throw new Exception("The ext-uuid extension is not loaded. Please make sure it's enabled in your PHP configuration.");
        }
    }
}
