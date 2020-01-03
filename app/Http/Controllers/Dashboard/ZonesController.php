<?php

namespace App\Http\Controllers\Dashboard;

use App\Govern;
use App\Zone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ZonesController extends Controller
{
    public function index(Request $request)
    {
        $governs = Govern::all();

        $zones = Zone::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->when($request->govern_id, function ($q) use ($request) {

            return $q->where('govern_id', $request->govern_id);

        })->latest()->paginate(5);

        return view('dashboard.zones.index', compact('governs', 'zones'));

    }//end of index

    public function create()
    {
        $governs = Govern::all();
        return view('dashboard.zones.create', compact('governs'));

    }//end of create

    public function store(Request $request)
    {
        $rules = [
            'govern_id' => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => 'required|unique:zone_translations,name'];
            // $rules += [$locale . '.description' => 'required'];

        }//end of  for each


        $request->validate($rules);

        $request_data = $request->all();

        Zone::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.zones.index');

    }//end of store

    public function edit(Zone $zone)
    {
        $governs = Govern::all();
        return view('dashboard.zones.edit', compact('Governs', 'zone'));

    }//end of edit

    public function update(Request $request, Zone $zone)
    {
        $rules = [
            'Govern_id' => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('zone_translations', 'name')->ignore($zone->id, 'zone_id')]];

        }//end of  for each


        $request->validate($rules);

        $request_data = $request->all();

        
        $zone->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.zones.index');

    }//end of update

    public function destroy(Zone $zone)
    {

        $zone->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.zones.index');

    }//end of destroy

}//end of controller
