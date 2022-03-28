<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\City;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    public function index()
    {
        return view('tables.airlines', [
            'content' => Airline::with('flights')->get()->toArray(),
            'cities'=> City::all(),
        ]);
    }

    public function fetch(Request $request)
    {
        logger($request);
        $count = $request->number;
        if (isset($count)) {
            logger($count);
            $count = $request->number;
            $airlines = Airline::withCount('flights')->get()->toArray();
            $return = [];
            foreach ($airlines as $airline) {
                logger($airline['flight_count']);
                if ($airline->flight_count >= $count) {
                    logger('if');
                    array_push($return, $airline);
                }
            }

            return response()->json([
                'airlines'=>$return,
            ]);
        } else {
            return response()->json([
                'airlines'=>Airline::withCount('flights')->get(),
            ]);
        }
//        $airlines = Airline::withCount('flights')->get();
//        logger($airlines);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:airlines|max:191',
                            'description'=>'required',
                            'cities'=>'required', ]);

        $airline = new Airline(['name'=>$request->input('name'),
                                'description'=>$request->input('description'), ]);

        $airline->save();
        $airline->availableCities()->sync($request->input('cities'));

        return response()->json([
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
            'airline' => $airline, ]);
    }

    public function update(Request $request)
    {
        $request->validate(['name' => 'required|unique:cities|max:191',
                            'description'=> 'required', ]);
        $airline = Airline::find($request->input('id'));
        $airline->name = $request->input('name');
        $airline->description = $request->input('description');
        $airline->save();

        return response()->json([
            'status' => 200,
            'message' => 'Airline updated successfully',
        ]);
    }
}
