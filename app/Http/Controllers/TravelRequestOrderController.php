<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\BookingStatus;
use App\Models\CarCategory;
use App\Models\CarType;
use App\Models\City;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\ClientType;
use App\Models\Employee;
use App\Models\Hotel;
use App\Models\Inventory;
use App\Models\InventoryAir;
use App\Models\InventoryAirSegment;
use App\Models\InventoryHotel;
use App\Models\InventoryMisc;
use App\Models\InventoryTax;
use App\Models\InventoryTransfer;
use App\Models\MealType;
use App\Models\MiscellaneousRates;
use App\Models\ProcessingCenter;
use App\Models\ProductCategory;
use App\Models\ProductType;
use App\Models\RoomCategory;
use App\Models\RoomType;
use App\Models\Route;
use App\Models\SalesFolder;
use App\Models\SalesFolderAir;
use App\Models\SalesFolderGroup;
use App\Models\SalesFolderHotel;
use App\Models\SalesFolderMisc;
use App\Models\SalesFolderPax;
use App\Models\SalesFolderTax;
use App\Models\SalesFolderTransfer;
use App\Models\SalesType;
use App\Models\ServiceClass;
use App\Models\Supplier;
use App\Models\TaxCode;
use App\Models\TempSalesFolderAir;
use App\Models\TempSalesFolderPax;
use App\Models\TempSalesFolderTax;
use App\Models\Vessel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Log;


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

    public function searchTicket($troNumber, $docId)
    {
        //Clear temporary data
        $this->truncateTemporaryPaxTable();
        $this->truncateTemporaryTaxTable();
        $this->truncateTemporaryAirTable();

        $inventory = Inventory::where('SF_NO', '')
            ->whereNull('SF_NO')
            ->get();

        return view('forms.tro_search_ticket',
            compact(
                'troNumber',
                'docId',
                'inventory',
            )
        );
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
        //Clear temporary data
        $this->truncateTemporaryPaxTable();
        $this->truncateTemporaryTaxTable();
        $this->truncateTemporaryAirTable();

        //Get current DOC ID
        $sfGroup = SalesFolderGroup::where('sf_no', $troNumber)
            ->orderBy('DOC_ID', 'desc')
            ->first();

        if (!$sfGroup) {
            // Get Next Doc ID
            $docId = 1;
        } else {
            // Get Next Doc ID
            $docId = $sfGroup->DOC_ID + 1;
        }

        //Get TRO details
        $sf = SalesFolder::where('SF_NO', $troNumber)
            ->first();

        //Get client types
        $clientTypes = ClientType::all();

        //Get client categories
        $clientCategories = ClientCategory::all();

        //Get agents
        $agents = Employee::select('EMP_ID', 'FULL_NAME')
            ->distinct()
            ->where('STATUS', 'Y')
            ->where('ACCESS_STATUS', 'Y')
            ->get();

            //Get sales type
        $salesTypes = SalesType::all();

        //Get existing products
        $existingProducts = SalesFolderGroup::where('SF_NO', $troNumber)->get();

        return view('forms/tro',
            compact(
                    'sf',
                    'docId',
                'clientTypes',
                'clientCategories',
                'agents',
                'salesTypes',
                'existingProducts',
            )
        );
    }

    public function addProductForm($troNumber)
    {
        //Clear tables with temporary data
        //$this->truncateTemporaryAirTable();
        //$this->truncateTemporaryPaxTable();

        //Get current DOC ID
        $sfGroup = SalesFolderGroup::where('sf_no', $troNumber)
            ->orderBy('DOC_ID', 'desc')
            ->first();

        if (!$sfGroup) {
            // Get Next Doc ID
            $docId = 1;
        } else {
            // Get Next Doc ID
            $docId = $sfGroup->DOC_ID + 1;
        }

        //Products
        $products = ProductType::all();
        $productCategories = ProductCategory::all();
        $routes = Route::all();

        //Air Itinerary
        $airlines = Airline::where('AL_DESCR','<>','')->orderBy('AL_DESCR', 'asc')->get();
        $serviceClasses = ServiceClass::all();
        $cities = City::orderBy('CITY_DESCR','asc')->get();

        //Hotel Itinerary
        $hotels = Hotel::orderBy('HOTEL_DESCR', 'asc')->get();
        $roomTypes = RoomType::all();
        $roomCategories = RoomCategory::all();
        //Meals
        $meals = MealType::all();

        //Car / Transfer
        $carTypes = CarType::all();
        $carCategories = CarCategory::all();
        $carSupplier = Supplier::where('STATUS', 'AC')
            ->orderBy('SUPP_NAME', 'asc')
            ->get();

        //Miscellaneous
        $processingCenters = ProcessingCenter::where('STATUS', 'Y')
            ->orderBy('PROC_DESCR', 'asc')
            ->get();
        $miscRates = MiscellaneousRates::where('STATUS', 'y')
            ->orderBy('MISC_DESCR', 'asc')
            ->get();

        //booking status
        $bookStatus = BookingStatus::all();

        //Vessel
        $vessels = Vessel::all();

        //Employees
        $employees = Employee::all();

        //Tax
        $taxes = TaxCode::where('STATUS', 'Y')
            ->orderBy('TAX_DESCR', 'asc')
            ->get();

        //Temp Tax data
        $tempTaxData = TempSalesFolderTax::all();

        //Temporary Pax data
        $tempPaxData = TempSalesFolderPax::all();
        $paxTicketNumber = TempSalesFolderPax::select('TICKET_NO')->first();
        if($paxTicketNumber != null) {
            $ticketInventory = Inventory::where('TICKET_NO', $paxTicketNumber->TICKET_NO)->first();
            $paxCount = TempSalesFolderPax::count();

            //clear temporary data
            $clearTempTable = $this->truncateTemporaryAirTable();
            if($clearTempTable) {
                $this->saveTemporaryAirTableWithTicket($troNumber, $docId, $paxTicketNumber->TICKET_NO);
            }

            $clearTax = $this->truncateTemporaryTaxTable();
            if($clearTax) {
                $this->saveTemporaryTaxTable($paxTicketNumber->TICKET_NO);
            }

            $airTempData = TempSalesFolderAir::all();
            $taxTempData = TempSalesFolderTax::all();
        } else {
            $ticketInventory = [];
            $paxCount = 0;
            $airTempData = [];
            $taxTempData = [];
        }

        return view('forms.tro_add_product', compact(
            'troNumber',
            'docId',
            'products',
            'airlines',
            'serviceClasses',
            'cities',
            'routes',
            'vessels',
            'hotels',
            'roomCategories',
            'roomTypes',
            'miscRates',
            'processingCenters',
            'bookStatus',
            'meals',
            'carTypes',
            'carCategories',
            'carSupplier',
            'productCategories',
            'tempPaxData',
            'paxTicketNumber',
            'ticketInventory',
            'paxCount',
            'airTempData',
            'taxTempData',
            'employees',
            'taxes',
            'tempTaxData',
        ));
    }

    public function saveTemporaryAirTableWithTicket($troNumber, $docId, $ticket)
    {
        try {
            Log::info('Ticket number selected: '.$ticket);

            // Get ticket info from Inventory Air Segment table
            $inventoryAirSegments = InventoryAirSegment::where('TICKET_NO', trim($ticket))->get();

            Log::info('Inventory Air Segment data: '. $inventoryAirSegments);

            // Insert data into the TEMP_SALES_FOLDER_AIR table
            foreach($inventoryAirSegments as $segment) {
                DB::table('TEMP_SALES_FOLDER_AIR')->insert([
                    'SF_NO' => $troNumber,
                    'DOC_ID' => $docId,
                    'AL_CODE' => $segment->AL_CODE,
                    'FLIGHT_NUM' => $segment->FLIGHT_NUM,
                    'SERVICE_CLASS' => $segment->SERVICE_CLASS,
                    'DEPT_CITY' => $segment->ORIG_CITY,
                    'DEPT_DATE' => $segment->ORIG_DATE,
                    'DEPT_TIME' => $segment->ORIG_TIME,
                    'ARVL_CITY' => $segment->DEST_CITY,
                    'ARVL_DATE' => $segment->DEST_DATE,
                    'ARVL_TIME' => $segment->DEST_TIME,
                ]);
            }

            Log::info('Data inserted into TEMP_SALES_FOLDER_AIR table successfully.');

            // Retrieve all data from the TEMP_SALES_FOLDER_AIR table
            $tempData = DB::table('TEMP_SALES_FOLDER_AIR')->get();

            Log::info('Retrieved data from TEMP_SALES_FOLDER_AIR table: ' . $tempData);

        } catch (\Exception $e) {
            Log::error('Error inserting data into TEMP_SALES_FOLDER_AIR table: ' . $e->getMessage());
        }
    }

    public function saveTemporaryTaxTable($ticket)
    {
        try {
            $inventoryTax = InventoryTax::where('TICKET_NO', $ticket)->get();

            foreach($inventoryTax as $tax) {
                TempSalesFolderTax::create([
                    'TAX_CODE' => $tax->TAX_CODE,
                    'TAX_NUM' => $tax->TAX_NUM,
                    'COST_CURR_CODE' => $tax->COST_CURR_CODE,
                    'COST_CURR_RATE' => $tax->COST_CURR_RATE,
                    'COST_AMOUNT' => $tax->COST_AMOUNT,
                    'SELL_CURR_CODE' => $tax->SELL_CURR_CODE,
                    'SELL_CURR_RATE' => $tax->SELL_CURR_RATE,
                    'SELL_AMOUNT' => $tax->SELL_AMOUNT,
                    'BILL_FLAG' => $tax->BILL_FLAG,
                    'INCL_FLAG' => $tax->INCL_FLAG,
                ]);
            }

            Log::info('Data saved: ' . $inventoryTax);

        } catch(\Exception $e) {
            Log::error('Error inserting data into TEMP_SALES_FOLDER_TAX table: ' . $e->getMessage());
        }
    }

    public function truncateTemporaryAirTable()
    {
        try {
            DB::table('TEMP_SALES_FOLDER_AIR')->truncate();
            Log::info('TEMP_SALES_FOLDER_AIR table truncated.');
            return response()->json(['message' => 'TEMP_SALES_FOLDER_AIR table truncated.'], 200);
        } catch (\Exception $e) {
            Log::error('Error truncating TEMP_SALES_FOLDER_AIR table: ' . $e->getMessage());
            return response()->json(['message' => 'Error truncating TEMP_SALES_FOLDER_AIR table.'], 500);
        }
    }

    public function truncateTemporaryPaxTable()
    {
        try {
            DB::table('TEMP_SALES_FOLDER_PAX')->truncate();
            Log::info('TEMP_SALES_FOLDER_PAX table truncated.');
            return response()->json(['message' => 'TEMP_SALES_FOLDER_PAX table truncated.'], 200);
        } catch (\Exception $e) {
            Log::error('Error truncating TEMP_SALES_FOLDER_PAX table: ' . $e->getMessage());
            return response()->json(['message' => 'Error truncating TEMP_SALES_FOLDER_PAX table.'], 500);
        }
    }

    public function truncateTemporaryTaxTable()
    {
        try {
            DB::table('TEMP_SALES_FOLDER_TAX')->truncate();
            Log::info('TEMP_SALES_FOLDER_TAX table truncated.');
            return response()->json(['message' => 'TEMP_SALES_FOLDER_TAX table truncated.'], 200);
        } catch (\Exception $e) {
            Log::error('Error truncating TEMP_SALES_FOLDER_TAX table: ' . $e->getMessage());
            return response()->json(['message' => 'Error truncating TEMP_SALES_FOLDER_TAX table.'], 500);
        }
    }

    public function productDetails($troNumber, $docId) {

        $sfGroup = SalesFolderGroup::where('SF_NO', $troNumber)
            ->where('DOC_ID', $docId)
            ->first();

        $productCategory = $sfGroup->PROD_CAT;

        //Air Itinerary
        $airlines = Airline::orderBy('AL_DESCR', 'asc')->get();
        $serviceClasses = ServiceClass::all();
        $cities = City::orderBy('CITY_DESCR','asc')->get();

        //Hotel Itinerary
        $hotels = Hotel::orderBy('HOTEL_DESCR', 'asc')->get();
        $roomTypes = RoomType::all();
        $roomCategories = RoomCategory::all();
        //Meals
        $meals = MealType::all();

        //Car / Transfer
        $carTypes = CarType::all();
        $carCategories = CarCategory::all();
        $carSupplier = Supplier::where('STATUS', 'AC')
            ->orderBy('SUPP_NAME', 'asc')
            ->get();

        //Miscellaneous
        $processingCenters = ProcessingCenter::where('STATUS', 'Y')
            ->orderBy('PROC_DESCR', 'asc')
            ->get();
        $miscRates = MiscellaneousRates::where('STATUS', 'y')
            ->orderBy('MISC_DESCR', 'asc')
            ->get();

        //booking status
        $bookStatus = BookingStatus::all();

        //Sales Folder Air
        $sfAir = SalesFolderAir::where('SF_NO', $troNumber)
            ->where('DOC_ID', $docId)
            ->get();

        //Sales Folder Hotel
        $sfHotel = SalesFolderHotel::where('SF_NO', $troNumber)
            ->where('DOC_ID', $docId)
            ->first();

        //Sales Folder Air
        $sfAirPax = SalesFolderPax::where('PROD_CAT', 'A')
            ->where('SF_NO', $troNumber)
            ->where('DOC_ID', $docId)
            ->get();

        //Sales Folder Tax
        $sfTax = SalesFolderTax::where('SF_NO', $troNumber)
            ->where('DOC_ID', $docId)
            ->get();

        $taxCodes = TaxCode::orderBy('TAX_DESCR', 'asc')->get();

        //Vessel
        $vessels = Vessel::all();

        $details = SalesFolderGroup::where('SF_NO', $troNumber)
            ->where('DOC_ID', $docId)
            ->get();

            $infoAir = SalesFolderAir::where('SF_NO', $troNumber)
                ->where('DOC_ID', $docId)
                ->get();

            $infoHotel = SalesFolderHotel::where('SF_NO', $troNumber)
                ->where('DOC_ID', $docId)
                ->get();

            $infoTransfer = SalesFolderTransfer::where('SF_NO', $troNumber)
                ->where('DOC_ID', $docId)
                ->first();

            $infoMisc = SalesFolderMisc::where('SF_NO', $troNumber)
                ->where('DOC_ID', $docId)
                ->first();

            $infoTax = SalesFolderTax::where('SF_NO', $troNumber)
                ->where('DOC_ID', $docId)
                ->get();

        if($productCategory == 'A') {
            return view('forms.tro_edit_product_air', compact([
                'troNumber',
                'docId',
                'details',
                'infoAir',
                'airlines',
                'serviceClasses',
                'cities',
                'vessels',
                'sfGroup',
                'sfAir',
                'sfAirPax',
                'sfTax',
                'taxCodes',
                'bookStatus',
            ]));
        } elseif ($productCategory == 'M') {
            return view('forms.tro_edit_product_misc', compact([
                'troNumber',
                'docId',
                'details',
                'infoMisc',
                'vessels',
                'processingCenters',
                'miscRates',
                'bookStatus',
                'serviceClasses',
            ]));
        } elseif ($productCategory == 'H') {
            return view('forms.tro_edit_product_hotel', compact([
                'troNumber',
                'docId',
                'details',
                'infoHotel',
                'vessels',
                'hotels',
                'roomTypes',
                'roomCategories',
                'meals',
                'bookStatus',
                'sfHotel',
            ]));
        } elseif ($productCategory == 'C') {
            return view('forms.tro_edit_product_transfer', compact([
                'troNumber',
                'docId',
                'details',
                'infoTransfer',
                'vessels',
                'carTypes',
                'carCategories',
                'carSupplier',
                'bookStatus',
            ]));
        }
    }
}
