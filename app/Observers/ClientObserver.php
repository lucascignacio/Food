<?php

namespace App\Observers;

use App\Models\Client;
use Illuminate\Support\Str;

class ClientObserver
{
    /**
     * Handle the Client "creating" event.
     */
    public function creating(Client $client)
    {
        $client->uuid = Str::uuid();
    }
}
