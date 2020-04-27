<?php

namespace App\Http\Controllers\Places;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Places\Place;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($data, [
            'name'      => ['required', 'string', 'max:120'],
            'capacity'  => ['required', 'string', 'max:6'],
            'howManyProjectors'  => ['max:2', 'required_with:hasProjector'],
            'howManyBooths'  => ['max:2', 'required_with:hasTranslationBooth'],
        ]);
      

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        /**
         * validate completed
         * 
         */

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
            return redirect()
                     ->back()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
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

        $validator = Validator::make($data, [
            'name'      => ['required', 'string', 'max:120'],
            'capacity'  => ['required', 'string', 'max:6'],
            'howManyProjectors'  => ['max:2', 'required_with:hasProjector'],
            'howManyBooths'  => ['max:2', 'required_with:hasTranslationBooth'],
        ]);
      

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        /**
         * validate completed
         * 
         */

        
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
            return redirect()
                     ->back()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
        }

        return redirect()->back()->with(['status' => Lang::get('Updated place')]);
    }


    /**
     * confirm before delete
     * 
     */

    public function confirmDestroy($id){
        $place = Place::findOrFail($id);

        return view('app.dashboard.places.confirm.delete', [
            'place' => $place
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
        $place = FindOrFail($id);

        $delete = $place->delete();

        if(!$delete){
            return redirect()
            ->back()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
        }

        return redirect()->route('places.index')->with(['status' => Lang::get('Place deleted')]);
    } 

    /**
     * confirm before forceDelete
     * 
     */

    public function confirmForceDestroy($id){
        $place = Place::onlyTrashed()->findOrFail($id);
        
        return view('app.dashboard.places.confirm.forceDelete', [
            'place' => $place
        ]);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy($id)
    {
        $place = Place::onlyTrashed()->FindOrFail($id);

        $delete = $place->forceDelete();

        if(!$delete){
            return redirect()
                     ->back()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
        }

        return redirect()->route('places.index')->with(['status' => Lang::get('Place permanently deleted')]);
    } 

    public function confirmRestore($id){
        $place = Place::onlyTrashed()->findOrFail($id);

        return view('app.dashboard.places.confirm.restore', [
            'place' => $place
        ]);
    }

    public function restore(){
        $place = Place::onlyTrashed()->findOrFail($id);

        $restore = $place->restore();

        if(!$restore){
            return redirect()
                     ->back()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
        }

        return redirect()->route('places.index')->with(['status' => Lang::get('Place restored')]);
    }
}
