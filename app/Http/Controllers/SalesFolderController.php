<?php

namespace App\Http\Controllers;

use App\Models\SalesFolder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class SalesFolderController extends Controller
{
    public function getData(Request $request)
    {
        $query = SalesFolder::query();

        // Filter based on form inputs
        if (!empty($request->ebcNo)) {
            $query->where('SF_NO', 'like', "%{$request->ebcNo}%");
        }
        if (!empty($request->client)) {
            $query->where('CLT_NAME', 'like', "%{$request->client}%");
        }
        if (!empty($request->dateCreated)) {
            $query->whereDate('SF_DATE', '=', $request->dateCreated);
        }
        if (!empty($request->status)) {
            $query->where('STATUS', $request->status);
        }

        return DataTables::of($query)->make(true);
    }

}
