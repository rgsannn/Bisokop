<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use App\Models\TheaterSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

class TheaterController extends Controller
{
    public function index()
    {
        $user = Auth::guard('staff')->user();
        $allTheater = Theater::with('TheaterSeat')->orderBy('type', 'asc')->get();
        return view('staff.theater.index', compact('user', 'allTheater'));
    }

    public function addProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price_economy' => 'required|numeric|min:0',
            'price_executive' => 'required|numeric|min:0',
            'price_sweetbox' => 'required|numeric|min:0',
            'row_economy' => 'required|array',
            'row_executive' => 'required|array',
            'row_sweetbox' => 'required|array',
        ]);

        if($validator->fails()) {
            return redirect('/staff/theater/')->with('alertError', $validator->errors()->first())->withInput();
        }

        DB::beginTransaction();
        try {
            // Insert new Theater data
            $theater = Theater::create([
                'name' => $request->input('name'),
                'type' => $request->input('type'),
            ]);
        
            $data = [
                [
                    'theater_id' => $theater->theater_id,
                    'row' => json_encode($request->row_sweetbox),
                    'price' => $request->price_sweetbox,
                    'type' => 'Sweetbox',
                ],
                [
                    'theater_id' => $theater->theater_id,
                    'row' => json_encode($request->row_executive),
                    'price' => $request->price_executive,
                    'type' => 'Executive',
                ],
                [
                    'theater_id' => $theater->theater_id,
                    'row' => json_encode($request->row_economy),
                    'price' => $request->price_economy,
                    'type' => 'Economy',
                ],
            ];
            
            TheaterSeat::insert($data);

            DB::commit();
            return redirect('/staff/theater/')->with('alertSuccess', 'Theater added successfully!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect('/staff/theater/')->with('alertError', $e->getMessage())->withInput();
        }
    }

    public function updateProcess(Theater $theater, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price_economy' => 'required|numeric|min:0',
            'price_executive' => 'required|numeric|min:0',
            'price_sweetbox' => 'required|numeric|min:0',
            'row_economy' => 'required|array',
            'row_executive' => 'required|array',
            'row_sweetbox' => 'required|array',
        ]);

        if($validator->fails()) {
            return redirect('/staff/theater/')->with('alertError', $validator->errors()->first())->withInput();
        }

        $input = $request->only(['name', 'type', 'price_economy', 'price_executive', 'price_sweetbox', 'row_economy', 'row_executive', 'row_sweetbox']);

        $theater->update($input);

        $seats = ['economy', 'executive', 'sweetbox'];

        foreach ($seats as $seat) {
            $theater->seatOfType($seat)->update([
                'price' => $input['price_'.$seat],
                'row' => json_encode($input['row_'.$seat])
            ]);
        }

        return redirect('/staff/theater/')->with('alertSuccess', 'Changes updated successfully!');
    }

    public function update(Theater $theater, Request $request)
    {
        $user = Auth::guard('staff')->user();
        if(!$request->ajax()) {
            return abort(403, 'No direct script access allowed!');
        }
        
        return view('staff.theater.update', compact('user', 'theater'));
    }

    public function delete(Theater $theater)
    {
        DB::beginTransaction();
        try {
            // Delete related TheaterSeat data
            TheaterSeat::where('theater_id', $theater->theater_id)->delete();

            // Delete Theater data
            Theater::where('theater_id', $theater->theater_id)->delete();

            DB::commit();
            return redirect('/staff/theater/')->with('alertSuccess', 'Theater deleted successfully!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect('/staff/theater/')->with('alertError', $e->getMessage())->withInput();
        }
    }

}
