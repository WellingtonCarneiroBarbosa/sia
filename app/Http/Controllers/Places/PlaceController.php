<?php

namespace App\Http\Controllers\Places;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Places\Place;
use App\Models\Places\PlaceLog;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\HistoricSchedule;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use DB;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places     = Place::paginate(config('app.paginate_limit'));

        $hasPlaces = hasData($places);

        return view('app.dashboard.places.index', [
            'hasPlaces' => $hasPlaces, 'places' => $places
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.dashboard.places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /**
         * Validate request
         * 
         */
        $data = $request->all();

        $data['size']  = sanitizeString($data['size']);

        $data['capacity'] = sanitizeString($data['capacity']);

        //dd($data['size'], $data['capacity']);
        $messages = ['unique' => Lang::get('There is already a registered place with this name')];

        $validator = Validator::make($data, [
            'name'      => ['required', 'string', 'max:120', 'unique:places'],
            'capacity'  => ['required', 'string', 'max:7', 'gt:0'],
            'size'  => ['required', 'string', 'max:14'],
            'howManyProjectors'  => ['max:2', 'required_with:hasProjector'],
            'howManyBooths'  => ['max:2', 'required_with:hasTranslationBooth'],
            'outletVoltage' => ['max:1', 'required', 'numeric'],
        ], $messages);

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        /**manual validation */
        if($data['size'] <= 5){
            $error = Lang::get('The size field must be greater than 5');
            return redirect()
            ->back()
            ->withErrors($error)
            ->withInput();
        }

        /**
         * validate completed
         * 
         */
        if($request->outletVoltage === "0"){
            $data['outletVoltage'] = null;
        }

        if($request->hasProjector){
            $data['hasProjector'] = true;
        }

        if($request->hasTranslationBooth){
            $data['hasTranslationBooth'] = true;
        }
        
        if($request->hasSound){
            $data['hasSound'] = true;
        }

        if($request->hasLighting){
            $data['hasLighting'] = true;
        }

        if($request->hasWifi){
            $data['hasWifi'] = true;
        }

        if($request->hasAccessibility){
            $data['hasAccessibility'] = true;
        }

        if($request->hasFreeParking){
            $data['hasFreeParking'] = true;
        }

        $create = Place::create($data);

        redirectBackIfThereIsAError($create);

        $dataLog = [''];

        /**
         * $createLog = PlaceLog::create($dataLog);
         * 
         * redirectBackIfThereIsAError($createLog);
         * 
         */

        return redirect()->back()->with(['status' => Lang::get('Registered Place')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::findOrFail($id);

        return view('app.dashboard.places.show', [
            'place' => $place
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::findOrFail($id);

        return view('app.dashboard.places.edit', [
            'place' => $place
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       /**
         * Validate request
         * 
         */
        $data = $request->all();

        $data['size']  = sanitizeString($data['size']);

        $data['capacity'] = sanitizeString($data['capacity']);

        $validator = Validator::make($data, [
            'name'      => ['required', 'string', 'max:120'],
            'capacity'  => ['required', 'string', 'max:6', 'gt:0'],
            'size'  => ['required', 'string', 'max:18'],
            'howManyProjectors'  => ['max:2', 'required_with:hasProjector'],
            'howManyBooths'  => ['max:2', 'required_with:hasTranslationBooth'],
            'outletVoltage' => ['max:1', 'required', 'numeric'],
        ]);

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $place = Place::findOrFail($id);

        $hasAlreadyPlace = Place::where('name', $data['name'])->where('created_at', '!=', $place['created_at'])->get();

        $hasAlreadyPlace = hasData($hasAlreadyPlace);

        if($hasAlreadyPlace)
        {
            $error = Lang::get('There is already a registered place with this name');
            return redirect()
            ->back()
            ->withErrors($error)
            ->withInput();
        }

        /**manual validation */
        if($data['size'] <= 5){
            $error = Lang::get('The size field must be greater than 5');
            return redirect()
            ->back()
            ->withErrors($error)
            ->withInput();
        }

        /**
         * validate completed
         * 
         */
        if($request->outletVoltage === "0"){
            $data['outletVoltage'] = null;
        }

        if($request->hasProjector){
            if( (int) $data['howManyProjectors'] === 0)
            {
                $data['hasProjector'] = null;
                $data['howManyProjectors'] = null;
            }else {
                $data['hasProjector'] = true;
            }
        }else {
            $data['hasProjector'] = null;
            $data['howManyProjectors'] = null;
        }

        if($request->hasTranslationBooth){
            if( (int) $data['howManyBooths'] === 0)
            {
                $data['hasTranslationBooth'] = null;
                $data['howManyBooths'] = null;
            }else {
                $data['hasTranslationBooth'] = true;
            }
        }else {
            $data['hasTranslationBooth'] = null;
            $data['howManyBooths'] = null;
        }

        if($request->hasSound){
            $data['hasSound'] = true;
        }else {
            $data['hasSound'] = null;
        }

        if($request->hasLighting){
            $data['hasLighting'] = true;
        }else {
            $data['hasLighting'] = null;
        }

        if($request->hasWifi){
            $data['hasWifi'] = true;
        }else {
            $data['hasWifi'] = null;
        }

        if($request->hasAccessibility){
            $data['hasAccessibility'] = true;
        }else {
            $data['hasAccessibility'] = null;
        }

        if($request->hasFreeParking){
            $data['hasFreeParking'] = true;
        }else {
            $data['hasFreeParking'] = null;
        }


        $placeUpdate = Place::findOrFail($id);

        $placeUpdate = $placeUpdate->update($data);

        redirectBackIfThereIsAError($placeUpdate);

        return redirect()->back()->with(['status' => Lang::get('Updated place')]);
    }


    /**
     * confirm before delete
     * 
     */

    public function confirmDestroy($id){
        $place = Place::findOrFail($id);

        $howManySchedulesAtThisPlace = Schedule::withTrashed()->where('place_id', $id)->count();

        $howManyHistoricSchedulesAtThisPlace = HistoricSchedule::withTrashed()->where('place_id', $id)->count();

        $howManySchedulesAtThisPlace = $howManySchedulesAtThisPlace + $howManyHistoricSchedulesAtThisPlace;
        
        return view('app.dashboard.places.confirm.delete', [
            'place' => $place,
            'howManySchedulesAtThisPlace' => $howManySchedulesAtThisPlace
        ]);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Place::destroy($id);

        redirectBackIfThereIsAError($delete);

        return redirect()->route('places.index')->with(['status' => Lang::get('Place permanently deleted') . ". " . Lang::get('System users were notified via email')]);
    } 
}
