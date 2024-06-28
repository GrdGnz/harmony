<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    public function getData(Request $request)
    {
        $query = Inventory::query();

        // Filter based on form inputs
        if (!empty($request->paxName)) {
            $query->where('FIRST_PAX_NAME', 'like', "%{$request->paxName}%");
        }
        if (!empty($request->ticketNumber)) {
            $query->where('TICKET_NO', 'like', "%{$request->ticketNumber}%");
        }
        if (!empty($request->pnr)) {
            $query->where('PNR', 'like',"%{$request->pnr}%");
        }

        // Filter out records where SF_NO is not empty or null
        $query->whereNull('SF_NO')->orWhere('SF_NO','');

        return DataTables::of($query)->make(true);
    }
}
