<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\PinCode;
use App\Models\ImportSummary;
use App\Jobs\ProcessCsvJob;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the home page.
     *
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        return View::make('home');
    }

    /**
     * Show the view page.
     *
     *
     * @return \Illuminate\View\View
     */
    public function showViewPage() {

        $data = PinCode::paginate(15);
        return view('view',compact('data'));
    }

    /**
     * Show the import page.
     *
     *
     * @return \Illuminate\View\View
     */
    public function showImportPage() {

        $import_summary = ImportSummary::first();
        return view('import', compact('import_summary'));
    }

    
    /**
     * Import data
     *
     *
     * @return \Illuminate\View\View
     */
    public function importData(Request $request) {

        //Truncating table
        ImportSummary::truncate();
        PinCode::truncate();

        //Generating import summary
        $import_summary = ImportSummary::create([
            'import_type' => 'Pin Code CSV Import',
            'import_status' => '0'
        ]);

        //Dispatching queue to import data from csv asynchronously
        dispatch(new ProcessCsvJob($import_summary->id));

        return redirect('/import');

    }
}
