<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function getClients(Request $request)
    {
        // Select only necessary columns
        $query = Client::select([
            'CLT_ID',
            'CLT_TYPE',
            'STATUS',
            'CLT_CODE',
            'FULL_NAME',
            'CATEGORY',
            'MAIL_ADDRESS',
            'PHONE_NO_1',
            'FAX_NO_1',
        ]);

        // Use eager loading if needed
        // Example: $query->with('category', 'type', 'salesAgent', 'contact');

        return DataTables::of($query)->make(true);
    }

}
