<?php

namespace App\Http\Controllers;

use App\Models\Mode;
use Illuminate\Http\Request;

class ModeController extends Controller
{
    public function index()
    {
        $data = Mode::all();
        return view('mode.index', compact('data'));
    }
    public function create()
    {
        return view('mode.add');
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
           'name' => 'required',
           'status' => 'required',
        ]);
        Mode::create($validate);
        return redirect()->route('mode.index');
    }
    public function destroy($id)
    {
        $data = Mode::findOrFail($id);
        $data->delete();
        return redirect()->route('mode.index');
    }
}
