<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\ClientType;
use App\Models\ClientCategory;
use App\Models\SalesType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class TravelRequestOrderController extends Controller
{
    public function index()
    {
        $clientTypes = ClientType::all();

        $clientCategories = ClientCategory::all();

        $agents = Employee::select('EMP_ID', 'FULL_NAME')
            ->distinct()
            ->where('STATUS', 'Y')
            ->where('ACCESS_STATUS', 'Y')
            ->get();

        $salesTypes = SalesType::all();

        return view('forms/tro',
            compact(
                'clientTypes',
                'clientCategories',
                'agents',
                'salesTypes',
            )
        );
    }

    public function addStock(Request $request)
    {
        try {
            // Get PDO connection
            $pdo = DB::connection()->getPdo();

            // Define the stored procedure call with placeholders for parameters
            $sql = "EXEC spGetNextMasterID @cLock = ?, @dtPeriod = ?, @sModuleCode = ?, @iNextID = ?";

            // Parameters to be passed to the stored procedure
            $cLock = 'Y';
            $dtPeriod = now()->format('Y-m-d'); // Uses Laravel's helper to format date
            $sModuleCode = 'SFD';
            $iNextID = -1; // Initial value for the output parameter

            // Prepare the statement
            $stmt = $pdo->prepare($sql);

            // Bind the parameters
            $stmt->bindParam(1, $cLock);
            $stmt->bindParam(2, $dtPeriod);
            $stmt->bindParam(3, $sModuleCode);
            $stmt->bindParam(4, $iNextID, \PDO::PARAM_INT|\PDO::PARAM_INPUT_OUTPUT, 4000); // Specify as output parameter

            // Execute the procedure
            if ($stmt->execute()) {
                return back()->with('success', 'Data saved successfully! Next ID: ' . $iNextID);
            } else {
                return back()->with('error', 'Error saving data');
            }

        } catch (\Exception $e) {
            // Handle error
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}