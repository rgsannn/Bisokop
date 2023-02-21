<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index()
    {
        $user = Auth::guard('staff')->user();
        $allFilms = Film::orderBy('title', 'asc')->get();
        return view('staff.film.index')->with(compact('user', 'allFilms'));
    }

    public function add()
    {
        $user = Auth::guard('staff')->user();
        return view('staff.film.add')->with(compact('user'));
    }

    public function update(Film $film)
    {
        $user = Auth::guard('staff')->user();
        return view('staff.film.update')->with(compact('user', 'film'));
    }

    public function delete(Film $film)
    {
        try {
            Storage::delete('film/' . $film->thumbnail);
            Storage::delete('cover/' . $film->cover);
            $film->delete();
            return redirect('/staff/films/')->with('alertSuccess', 'Film deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/staff/films/')->with('alertError', 'Failed to delete film: ' . $e->getMessage());
        }
    }

    public function addProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'required|mimes:png,jpg,jpeg|max:2048',
            'cover' => 'required|mimes:png,jpg,jpeg|max:2048',
            'title' => 'required',
            'director' => 'required',
            'genre' => 'required',
            'rating' => 'required|numeric|min:0|max:5',
            'age_rating' => 'required',
            'duration' => 'required',
            'url_trailer' => 'required',
            'status' => 'required|in:publish,unpublish',
            'description' => 'required',
        ]);
        if($validator->fails()) {
            return redirect('/staff/films/add')->with('alertError', $validator->errors()->first())
                ->withInput();
        }
        
        $thumbnail = $request->file('thumbnail')->store('film');
        $cover = $request->file('cover')->store('cover');

        Film::create([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'thumbnail' => str_replace('film/', '', $thumbnail),
            'cover' => str_replace('cover/', '', $cover),
            'rating' => $request->rating,
            'genre' => $request->genre,
            'director' => $request->director,
            'age_rating' => $request->age_rating,
            'url_trailer' => $request->url_trailer,
            'status' => $request->status,
        ]);

        return redirect('/staff/films')->with('alertSuccess', 'New film added successfully.');
    }

    public function updateProcess(Film $film, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'director' => 'required',
            'genre' => 'required',
            'rating' => 'required|numeric|min:0|max:5',
            'age_rating' => 'required',
            'duration' => 'required',
            'url_trailer' => 'required',
            'status' => 'required|in:publish,unpublish',
            'description' => 'required',
        ]);
        if($validator->fails()) {
            return redirect('/staff/films/update/' . $film->film_id)->with('alertError', $validator->errors()->first())
                ->withInput();
        }

        $film->title = $request->title;
        $film->description = $request->description;
        $film->duration = $request->duration;
        $film->rating = $request->rating;
        $film->age_rating = $request->age_rating;
        $film->url_trailer = $request->url_trailer;
        $film->status = $request->status;

        if(!empty($request->hasFile('thumbnail'))) {
            Storage::delete('film/' . $film->thumbnail);

            $thumbnail = $request->file('thumbnail')->store('film');
            $film->thumbnail = str_replace('film/', '', $thumbnail);
        }

        if(!empty($request->hasFile('cover'))) {
            Storage::delete('cover/' . $film->cover);

            $cover = $request->file('cover')->store('cover');
            $film->cover = str_replace('cover/', '', $cover);
        }

        $film->save();
        return redirect('/staff/films/update/' . $film->film_id)->with('alertSuccess', 'Changes saved successfully!');
    }
}
