<?php

namespace App\Http\Controllers\Dashboard;

use App\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class RegionsController extends Controller
{
    public function index(Request $request)
    {
        $regions = Region::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->latest()->paginate(5);

        return view('dashboard.regions.index', compact('regions'));

    }//end of index

    public function create()
    {
        return view('dashboard.regions.create');

    }//end of create

    public function store(Request $request)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('region_translations', 'name')]];

        }//end of for each

        $request->validate($rules);

        Region::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.regions.index');

    }//end of store

    public function edit(Region $region)
    {
        return view('dashboard.regions.edit', compact('region'));

    }//end of edit

    public function update(Request $request, Region $region)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('region_translations', 'name')->ignore($region->id, 'region_id')]];

        }//end of for each

        $request->validate($rules);

        $region->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.regions.index');

    }//end of update

    public function destroy(Region $region)
    {
        $region->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.regions.index');

    }//end of destroy

}//end of controller
