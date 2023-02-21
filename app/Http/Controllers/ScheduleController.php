<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Schedules;
use App\Models\Theater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

class ScheduleController extends Controller
{
    public function index()
    {
        $user = Auth::guard('staff')->user();
        $allTheater = Theater::orderBy('name', 'asc')->get();
        $allFilm = Film::orderBy('title', 'asc')->get();
        $allSchedule = Schedules::orderBy('date', 'asc')->get();
        return view('staff.schedule.index')->with(compact('user', 'allTheater', 'allFilm', 'allSchedule'));
    }

    public function addProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date_format:Y-m-d',
            'times.*' => 'required|date_format:H:i',
            'theater_id' => 'required|exists:theater,theater_id',
            'film_id' => 'required|exists:films,film_id'
        ]);

        if ($validator->fails()) {
            return redirect('/staff/schedule')->with('alertError', $validator->errors()->first())->withInput();
        }

        Schedules::create([
            'theater_id' => $request->input('theater_id'),
            'film_id' => $request->input('film_id'),
            'date' => $request->input('date'),
            'time' => json_encode($request->input('times')),
        ]);

        return redirect('/staff/schedule')->with('alertSuccess', 'Schedule added successfully!');
    }

    public function update(Schedules $schedules, Request $request)
    {
        $user = Auth::guard('staff')->user();
        if(!$request->ajax()) {
            return abort(403, 'No direct script access allowed!');
        }
        
        $allTheater = Theater::orderBy('name', 'asc')->get();
        $allFilm = Film::orderBy('title', 'asc')->get();
        return view('staff.schedule.update')->with(compact('user', 'allTheater', 'allFilm', 'schedules'));
    }

    public function updateProcess(Schedules $schedules, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date_format:Y-m-d',
            'times.*' => 'required|date_format:H:i',
            'theater_id' => 'required|exists:theater,theater_id',
            'film_id' => 'required|exists:films,film_id'
        ]);

        if ($validator->fails()) {
            return redirect('/staff/schedule')->with('alertError', $validator->errors()->first())->withInput();
        }

        $schedules->date = $request->input('date');
        $schedules->time = json_encode($request->input('times'));
        $schedules->theater_id = $request->input('theater_id');
        $schedules->film_id = $request->input('film_id');
        $schedules->save();

        return redirect('/staff/schedule')->with('alertSuccess', 'Schedule updated successfully!');
    }


    public function delete(Schedules $schedules)
    {
        DB::beginTransaction();
        try {
            Schedules::where('schedule_id', $schedules->schedule_id)->delete();

            DB::commit();
            return redirect('/staff/schedule')->with('alertSuccess', 'Schedule deleted successfully!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect('/staff/schedule')->with('alertError', $e->getMessage())->withInput();
        }
    }

}
