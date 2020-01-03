<?php

namespace App\Http\Controllers\Dashboard;

use App\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AreasController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->latest()->paginate(5);

        return view('dashboard.areas.index', compact('areas'));

    }//end of index

    public function create()
    {
        return view('dashboard.Areas.create');

    }//end of create

    public function store(Request $request)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('Area_translations', 'name')]];

        }//end of for each

        $request->validate($rules);

        Area::create($request);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.Areas.index');

    }//end of store

    public function edit(Area $area)
    {
        return view('dashboard.Areas.edit', compact('area'));

    }//end of edit

    public function update(Request $request, Area $area)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('Area_translations', 'name')->ignore($area->id, 'Area_id')]];

        }//end of for each

        $request->validate($rules);

        $area->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.Areas.index');

    }//end of update

    public function destroy(Area $area)
    {
        $area->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.Areas.index');

    }//end of destroy

}//end of controller
