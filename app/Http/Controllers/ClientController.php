<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClientController extends Controller
{
    public function index()
    {
        // Attempt to retrieve the cached clients data; if it doesn't exist, cache it
        $clients = Cache::remember('clients_data', now()->addMinutes(60), function () {
            // Eager load the 'contact' relationship to prevent the N+1 problem
            $allClients = Client::with('contact') // Eager loading to improve performance
                            ->where('STATUS', 'AC')
                            ->where('FULL_NAME', '!=', '')
                            ->get();

            return $allClients->map(function ($client) {
                // Optional helper ensures no errors if 'contact' is null
                return [
                    'FULL_NAME' => $client->FULL_NAME,
                    'CLT_CODE' => $client->CLT_CODE,
                    'CLT_TYPE' => $client->CLT_TYPE,
                    'MAIL_ADDRESS' => $client->MAIL_ADDRESS,
                    'CATEGORY' => $client->CATEGORY,
                    'PHONE_NO' => optional($client->contact)->PHONE_NO,
                    'FAX_NO' => optional($client->contact)->FAX_NO,
                    'EMAIL' => optional($client->contact)->EMAIL,
                    'CONTACT_NAME' => optional($client->contact)->CONTACT_NAME,
                ];
            });
        });

        return response()->json($clients);
    }
}
