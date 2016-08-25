<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Accompaniment;
use App\Arranger;
use App\Composer;
use App\Publisher;
use App\Sheet;
use App\Voicing;

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
            'arranger_id' => 'required|max:255',
            'voicing_id' => 'required|max:255',
            'accompaniment_id' => 'required|max:255',
            'publisher_number' => 'required|max:255',
            'publisher_id' => 'required|max:255',
            'copyright_year' => 'required|max:255',
            'quantity' => 'required|max:5',
            'legal_table_id' => 'required|max:1'
        ]);

        //build and save query
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
        $sheet->quantity = $request->input('quantity');
        $sheet->legal_table_id = $request->input('legal_table_id');

        $sheet->save();

        //send success and back to index
        session()->flash('msg', $request->input('sheet_name') . 'saved!');
        return redirect()->back();
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData(Datatables $datatables)
    {
        $sheets = Sheet::with('composer', 'arranger', 'accompaniment', 'legal_table', 'publisher', 'voicing')->select('sheets.*');

        return $datatables->usingEloquent($sheets)
            ->addColumn('action', function ($sheets) {
                return '<button class="btn btn-delete" data-remote="http://localhost/delete/' . $sheets->id . '">Delete</button>&nbsp;<button class="btn btn-info" onclick="location.href=\'/edit/' . $sheets->id . '\';">Edit</button>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }
}
