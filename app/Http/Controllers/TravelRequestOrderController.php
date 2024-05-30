<?php

namespace App\Http\Controllers;

use App\Models\BookingStatus;
use App\Models\CarCategory;
use App\Models\CarType;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\ClientType;
use App\Models\Employee;
use App\Models\Hotel;
use App\Models\MealType;
use App\Models\ProductCategory;
use App\Models\ProductType;
use App\Models\Route;
use App\Models\SalesFolder;
use App\Models\SalesType;
use App\Models\Vessel;
use App\Models\RoomCategory;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            // Retrieve the last SF_NO from the SalesFolder table
            $lastSFNo = SalesFolder::orderBy('SF_NO', 'desc')->pluck('SF_NO')->first();
            $latestSFNo = $lastSFNo + 1;

            // Get PDO connection
            $pdo = DB::connection()->getPdo();

            // Define the stored procedure call with placeholders for parameters
            $sql = "EXEC spGetNextMasterID @cLock = ?, @dtPeriod = ?, @sModuleCode = ?, @iNextID = ?";

            // Parameters to be passed to the stored procedure
            $cLock = 'N';
            $dtPeriod = now()->format('Y-m-d'); // Uses Laravel's helper to format date
            $sModuleCode = 'SFD';
            $iNextID = $latestSFNo; // Initial value for the output parameter

            // Prepare the statement
            $stmt = $pdo->prepare($sql);

            // Bind the parameters
            $stmt->bindParam(1, $cLock);
            $stmt->bindParam(2, $dtPeriod);
            $stmt->bindParam(3, $sModuleCode);
            $stmt->bindParam(4, $iNextID, \PDO::PARAM_INT|\PDO::PARAM_INPUT_OUTPUT, 4000); // Specify as output parameter

            // Execute the procedure
            if ($stmt->execute()) {

                // Create a new SalesFolder record
            $salesFolder = new SalesFolder();
            $salesFolder->SF_NO = '0'.$iNextID;
            $salesFolder->SF_DATE = $dtPeriod;
            $salesFolder->DUE_DATE = $dtPeriod;
            $salesFolder->CRT_DATE = $dtPeriod;
            $salesFolder->CREDIT_TERM = 0;
            $salesFolder->STATUS = 'OP';
            $salesFolder->BOOK_STATUS = 'OP';
            $salesFolder->BILL_CURR_CODE = 'PHP';
            $salesFolder->FOREIGN_CURR_CODE = 'USD';
            $salesFolder->BOOK_YEAR = now()->format('Y');
            $salesFolder->CLT_ID = $request->input('clientID');
            $salesFolder->CLT_TYPE = $request->input('clientType');
            $salesFolder->CLT_CODE = $request->input('clientCode');
            $salesFolder->CLT_NAME = $request->input('clientName');
            $salesFolder->CLT_CAT = $request->input('category');
            $salesFolder->CLT_ADDRESS = $request->input('clientAddress');
            $salesFolder->CLT_CONTACT = $request->input('contactName');
            $salesFolder->TRIP_DATE = $request->input('tripDate');
            $salesFolder->SALES_AGENT = $request->input('salesAgentID');
            $salesFolder->SALES_TYPE = $request->input('salesTypeID');
            $salesFolder->BOOKED_BY = $request->input('salesAgentID');
            $salesFolder->TICKETED_BY = $request->input('salesAgentID');
            $salesFolder->CRT_BY = $request->input('salesAgentID');

                // Save the SalesFolder record
                if ($salesFolder->save()) {
                    return back()->with('success', 'Saved')
                        ->with('iNextID', '0'.$iNextID)
                        ->with('dtPeriod', $dtPeriod);;
                } else {
                    return back()->with('error', 'Error saving SalesFolder record.');
                }
            } else {
                return back()->with('error', 'Error saving data');
            }

        } catch (\Exception $e) {
            // Handle error
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function searchForm()
    {
        $salesFolders = SalesFolder::all();

        return view('forms.search_tro',
            compact(
                'salesFolders',
            )
        );
    }

    public function searchClient()
    {
        $clients = Client::all();

        return view('forms.clients_tro', compact([
            'clients',
        ]));
    }


    public function clientForm($clientId)
    {
        $client = Client::where('CLT_ID', $clientId)
            ->first();

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
                    'client',
                'clientTypes',
                'clientCategories',
                'agents',
                'salesTypes',
            )
        );
    }

    public function troForm($troNumber)
    {
        $sf = SalesFolder::where('SF_NO', $troNumber)
            ->first();

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
                    'sf',
                'clientTypes',
                'clientCategories',
                'agents',
                'salesTypes',
            )
        );
    }

    public function addProductForm($troNumber)
    {
        $products = ProductType::all();
        $productCategories = ProductCategory::all();
        $routes = Route::all();

        //Hotel Itinerary
        $hotels = Hotel::all();
        $roomTypes = RoomType::all();
        $roomCategories = RoomCategory::all();
        //Meals
        $meals = MealType::all();

        //Car / Transfer
        $carTypes = CarType::all();
        $carCategories = CarCategory::all();

        //booking status
        $bookStatus = BookingStatus::all();

        //Vessel
        $vessels = Vessel::all();

        return view('forms.tro_add_product', compact(
            'troNumber',
            'products',
            'routes',
            'vessels',
            'hotels',
            'roomCategories',
            'roomTypes',
            'bookStatus',
            'meals',
            'carTypes',
            'carCategories',
            'productCategories',
        ));
    }

}
