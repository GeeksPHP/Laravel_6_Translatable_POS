<?php

namespace App\Http\Controllers\Dashboard;

use App\Region;
use App\Govern;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class GovernController extends Controller
{
    public function index(Request $request)
    {
        $regions = Region::all();

        $governs = Govern::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->when($request->region_id, function ($q) use ($request) {

            return $q->where('region_id', $request->region_id);

        })->latest()->paginate(5);

        return view('dashboard.governs.index', compact('regions', 'governs'));

    }//end of index

    public function create()
    {
        $regions = Region::all();
        return view('dashboard.governs.create', compact('regions'));

    }//end of create

    public function store(Request $request)
    {
        $rules = [
            'region_id' => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => 'required|unique:govern_translations,name'];
            // $rules += [$locale . '.description' => 'required'];

        }//end of  for each

        // $rules += [
        //     'purchase_price' => 'required',
        //     'sale_price' => 'required',
        //     'stock' => 'required',
        // ];

        $request->validate($rules);

        $request_data = $request->all();

        // if ($request->image) {

        //     Image::make($request->image)
        //         ->resize(300, null, function ($constraint) {
        //             $constraint->aspectRatio();
        //         })
        //         ->save(public_path('uploads/govern_images/' . $request->image->hashName()));

        //     $request_data['image'] = $request->image->hashName();

        // }//end of if

        govern::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.governs.index');

    }//end of store

    public function edit(govern $govern)
    {
        $regions = Region::all();
        return view('dashboard.governs.edit', compact('regions', 'govern'));

    }//end of edit

    public function update(Request $request, govern $govern)
    {
        $rules = [
            'region_id' => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('govern_translations', 'name')->ignore($govern->id, 'govern_id')]];
            // $rules += [$locale . '.description' => 'required'];

        }//end of  for each

        // $rules += [
        //     'purchase_price' => 'required',
        //     'sale_price' => 'required',
        //     'stock' => 'required',
        // ];

        $request->validate($rules);

        $request_data = $request->all();

        // if ($request->image) {

        //     if ($govern->image != 'default.png') {

        //         Storage::disk('public_uploads')->delete('/govern_images/' . $govern->image);
                    
        //     }//end of if

        //     Image::make($request->image)
        //         ->resize(300, null, function ($constraint) {
        //             $constraint->aspectRatio();
        //         })
        //         ->save(public_path('uploads/govern_images/' . $request->image->hashName()));

        //     $request_data['image'] = $request->image->hashName();

        // }//end of if
        
        $govern->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.governs.index');

    }//end of update

    public function destroy(govern $govern)
    {
        // if ($govern->image != 'default.png') {

        //     Storage::disk('public_uploads')->delete('/govern_images/' . $govern->image);

        // }//end of if

        $govern->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.governs.index');

    }//end of destroy

}//end of controller
