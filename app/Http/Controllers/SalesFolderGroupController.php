<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesFolder;
use App\Models\SalesFolderGroup;

class SalesFolderGroupController extends Controller
{
    public function create(Request $request)
    {
        $troNumber = $request->input('troNumber');

        $sfGroup = SalesFolderGroup::where('sf_no', $troNumber)
            ->orderBy('DOC_ID','desc')
            ->first();

        //Get Next Doc ID
        $docId = $sfGroup->DOC_ID;
        $nextDocId = $docId + 1;

        $prodType = $request->input('productType');
        $prodCategory = $request->input('productCategory');



    }
}
