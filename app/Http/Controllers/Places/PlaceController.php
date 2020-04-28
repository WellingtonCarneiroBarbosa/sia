<?php

namespace App\Http\Controllers\Places;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Places\Place;
use App\Models\Schedules\Schedule;
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

        $data['size']  = preg_replace('/[.]/', '', $data['size'] );
        $data['size']  = str_replace(',', '.', $data['size']);

        $data['capacity'] = removeComas($data['capacity']);

        $messages = ['unique' => Lang::get('There is already a registered place with this name')];

        $validator = Validator::make($data, [
            'name'      => ['required', 'string', 'max:120', 'unique:places'],
            'capacity'  => ['required', 'string', 'max:6', 'gt:0'],
            'size'  => ['required', 'string', 'max:18'],
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

        if(!$create){
            $error = Lang::get('Something went wrong. Please try again!');
            return redirect()
            ->back()
            ->withErrors($error)
            ->withInput();
        }

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

        $data['size']  = preg_replace('/[.]/', '', $data['size'] );
        $data['size']  = str_replace(',', '.', $data['size']);

        $data['capacity'] = removeComas($data['capacity']);

        $messages = ['unique' => Lang::get('There is already a registered place with this name')];

        $validator = Validator::make($data, [
            'name'      => ['required', 'string', 'max:120', 'unique:places'],
            'capacity'  => ['required', 'string', 'max:6', 'gt:0'],
            'size'  => ['required', 'string', 'max:18'],
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
        }else {
            $data['hasProjector'] = null;
            $data['howManyProjectors'] = null;
        }

        if($request->hasTranslationBooth){
            $data['hasTranslationBooth'] = true;
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

        if(!$placeUpdate){
            $error = Lang::get('Something went wrong. Please try again!');
            return redirect()
                    ->back()
                    ->withErrors($error)
                    ->withInput();
        }

        return redirect()->back()->with(['status' => Lang::get('Updated place')]);
    }


    /**
     * confirm before delete
     * 
     */

    public function confirmDestroy($id){
        $place = Place::findOrFail($id);

        $howManySchedulesAtThisPlace = Schedule::withTrashed()->where('place_id', $id)->count();

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
        $place = Place::findOrFail($id);

        $delete = $place->delete();

        if(!$delete){
            $error = Lang::get('Something went wrong. Please try again!');
            return redirect()
                    ->back()
                    ->withErrors($error)
                    ->withInput();
        }

        $now = date('Y-m-d H:i:s');

        $expiredSchedules = Schedule::withTrashed()->where('place_id', null)->get();

        $hasExpiredSchedules = hasData($expiredSchedules);

        if($hasExpiredSchedules){
            foreach($expiredSchedules as $schedule){
              $data = array(
                  'title'   => $schedule->title, 'place_id'     => $schedule->place_id, 'start'     => $schedule->start,
                  'end'     => $schedule->end, 'customer_id'    => $schedule->customer_id, 'status' => $schedule->status,
              );

              $historic = DB::insert('INSERT INTO historic_schedules (title, place_id, start, end, customer_id, status, created_at, updated_at, deleted_at)
              values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
              [
                  $schedule->title,       $schedule->place_id,        $schedule->start,
                  $schedule->end,         $schedule->customer_id,     $schedule->status,
                  $schedule->created_at,  $schedule->updated_at,      $schedule->deleted_at
              ]);

              $delete = DB::delete('DELETE FROM schedules WHERE id = ?', [$schedule->id]);
            }
        }

        return redirect()->route('places.index')->with(['status' => Lang::get('Place deleted')]);
    } 
}
