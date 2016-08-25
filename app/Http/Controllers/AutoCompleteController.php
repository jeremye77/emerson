<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Accompaniment;
use App\Arranger;
use App\Composer;
use App\Publisher;
use App\Voicing;

class AutoCompleteController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('autocomplete.index');
    }

    /**
     * @param Request $request
     * @return array
     */
    //TODO: Check performance of one query vs many. Creating as many for prototype optimisation may very well be needed.
    public function searchAccompaniment(Request $request)
    {
        $query = $request->get('term', '');

        $accompaniments = Accompaniment::where('accompaniment', 'LIKE', '%' . $query . '%')->get();

        $data = array();
        foreach ($accompaniments as $accompaniment) {
            $data[] = array('value' => $accompaniment->accompaniment, 'id' => $accompaniment->id);
        }
        if (count($data))
            return $data;
        else
            return ['value' => 'No Result Found', 'id' => ''];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function searchArranger(Request $request)
    {
        $query = $request->get('term', '');

        $arrangers = Arranger::where('arranger', 'LIKE', '%' . $query . '%')->get();

        $data = array();
        foreach ($arrangers as $arranger) {
            $data[] = array('value' => $arranger->arranger, 'id' => $arranger->id);
        }
        if (count($data))
            return $data;
        else
            return ['value' => 'No Result Found', 'id' => ''];

    }

    public function searchComposer(Request $request)
    {
        $query = $request->get('term', '');

        $composers = Composer::where('composer', 'LIKE', '%' . $query . '%')->get();

        $data = array();
        foreach ($composers as $composer) {
            $data[] = array('value' => $composer->composer, 'id' => $composer->id);
        }
        if (count($data))
            return $data;
        else
            return ['value' => 'No Result Found', 'id' => ''];
    }

    public function searchPublisher(Request $request)
    {
        $query = $request->get('term', '');

        $publishers = Publisher::where('publisher', 'LIKE', '%' . $query . '%')->get();

        $data = array();
        foreach ($publishers as $publisher) {
            $data[] = array('value' => $publisher->accompaniment, 'id' => $publisher->id);
        }
        if (count($data))
            return $data;
        else
            return ['value' => 'No Result Found', 'id' => ''];
    }

    public function searchVoicing(Request $request)
    {
        $query = $request->get('term', '');

        $voicings = Voicing::where('voicing', 'LIKE', '%' . $query . '%')->get();

        $data = array();
        foreach ($voicings as $voicing) {
            $data[] = array('value' => $voicing->voicing, 'id' => $voicing->id);
        }
        if (count($data))
            return $data;
        else
            return ['value' => 'No Result Found', 'id' => ''];
    }
}
