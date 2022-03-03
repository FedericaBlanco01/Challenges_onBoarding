<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AirlineController extends Controller
{
    public function index()
    {
        return view('tables.airlines', [
            'content' => Airline::with('flights')->get()->toArray(),
        ]);
    }
    public function fetch()
    {
        $airlines= Airline::withCount('flights')->get();
        return response()->json([
            'airlines'=>$airlines,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:airlines|max:191',
                            'description'=>'required']);

        $airline = new Airline(['name'=>$request->input('name'),
                                'description'=>$request->input('description')]);
        $airline->save();

        return respone()->json([
            'status' => 200,
            'message' => 'Airline added successfully!',
            'airline'=> $airline,
        ]);
    }

    public function destroy($id)
    {
        $airline = Airline::find($id);
        $airline->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Airline deleted successfully!',
        ]);
    }

    public function edit($id)
    {
        $airline = Airline::find($id);
        return view('components.updateAirline', [
            'airline' => $airline]);
    }

    public function update(Request $request)
    {
        $request->validate(['name' => 'required|unique:cities|max:191',
                            'description'=> 'required']);
        $airline= Airline::find($request->input('id'));
        $airline->name=$request->input('name');
        $airline->description=$request->input('description');
        $airline->save();

        return response()->json([
            'status' => 200,
            'message' => 'Airline updated successfully',
        ]);

    }

}
