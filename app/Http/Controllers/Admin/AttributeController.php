<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $attributes = Attribute::latest()->paginate(10);
        return view('admin.attribute.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request ->validate([
            'name' => 'required'
        ]);
        Attribute::create([
            'name' => $request->name
        ]);
        alert()->success('ویژگی مورد نظر','با موفقیت ثبت شد');
        return Redirect::route('admin.attributes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        //

        return view('admin.attribute.show',compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        //
        return view('admin.attribute.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $attribute->update([
            'name' => $request->name
        ]);

        alert()->success('ویژگی مورد نظر','با موفقیت ویژایش شد');
        return Redirect::route('admin.attributes.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
