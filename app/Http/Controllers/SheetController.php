<?php

namespace App\Http\Controllers;

use App\Accompaniment;
use App\Arranger;
use App\Composer;
use App\Publisher;
use App\Sheet;
use App\Voicing;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class SheetController extends Controller
{
    public function index()
    {
        return view('sheets.index');


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //simple validation
        $this->validate($request, [
            'sheet_name' => 'required|max:255',
            'composer_id' => 'required|max:255',
            'voicing_id' => 'required|max:255',
            'accompaniment_id' => 'required|max:255',
            'quantity' => 'required|max:5',
            'legal_table_id' => 'required|max:1'
        ]);

        //build and save query
        // TODO: This will accept and insert an empty value. I accept that over inserting "none" into the lookup tables. Though this might be riding on a bug or some such. Do some real validation
        $sheet = new Sheet;
        $sheet->sheet_name = $request->input('sheet_name');
        //check if object exists in lookup table -- if so grab id -- if not create then grab id
        $sheet->composer_id = Composer::firstOrCreate(['composer' => $request->input('composer_id')])->id;
        $sheet->arranger_id = Arranger::firstOrCreate(['arranger' => $request->input('arranger_id')])->id;
        $sheet->voicing_id = Voicing::firstOrCreate(['voicing' => $request->input('voicing_id')])->id;
        $sheet->accompaniment_id = Accompaniment::firstOrCreate(['accompaniment' => $request->input('accompaniment_id')])->id;
        $sheet->publisher_number = $request->input('publisher_number');
        //check if object exists in lookup table -- if so grab id -- if not create then grab id
        $sheet->publisher_id = Publisher::firstOrCreate(['publisher' => $request->input('publisher_id')])->id;
        $sheet->copyright_year = $request->input('copyright_year');
        $sheet->sheet_alternative_name  = $request->input('sheet_alternative_title');
        $sheet->quantity = $request->input('quantity');
        $sheet->legal_table_id = $request->input('legal_table_id');

        $sheet->save();

        //send success and back to index
        $request->session()->flash('alert-success', 'Nice! ' .$request->input('sheet_name'). ' saved.');
        return view('sheets.store')->withInput($request);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function patch(Request $request, $id)
    {
        $id = $request->id;
        $sheet = Sheet::with('composer', 'arranger', 'accompaniment', 'legal_table', 'publisher', 'voicing')->findOrFail($id);
        return view('sheets.edit')->withSheet($sheet);


    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('sheets.store');

    }

    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('sheets.index');
    }

    /**
     *
     * @param $id
     * @return int
     */
    public function destroy($id)
    {
        $affectedRows = Sheet::destroy($id);
        return $affectedRows;
    }

    /**
     * @param Datatables $datatables
     * @return mixed
     */
    public function anyData(Datatables $datatables)
    {
        $sheets = Sheet::join('accompaniments', 'sheets.accompaniment_id', '=', 'accompaniments.id')
            ->join('arrangers', 'sheets.arranger_id', '=', 'arrangers.id')
            ->join('composers', 'sheets.composer_id', '=', 'composers.id')
            ->join('legal_tables', 'sheets.legal_table_id', '=', 'legal_tables.id')
            ->join('publishers', 'sheets.publisher_id', '=', 'publishers.id')
            ->join('voicings', 'sheets.voicing_id', '=', 'voicings.id')
            ->select('sheets.id as id','sheets.sheet_name as name', 'sheets.sheet_alternative_name as altname', 'composers.composer as composer',
                        'arrangers.arranger as arranger', 'voicings.voicing as voicing', 'accompaniments.accompaniment as accompaniment',
                            'sheets.publisher_number as publisherno', 'publishers.publisher as publisher',
                                'sheets.copyright_year as copyright', 'sheets.quantity as quantity', 'legal_tables.legal as legal');

        return Datatables::of($sheets)
            ->addColumn('action', function ($sheets) {
                return '<button class="btn btn-delete" data-remote="/delete/' . $sheets->id . '">Delete</button>&nbsp;<button class="btn btn-info" onclick="location.href=\'/edit/' . $sheets->id . '\';">Edit</button>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }
}