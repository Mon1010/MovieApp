<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;


class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmbd.tokens'))
        ->get('https://api.themoviedb.org/3/movie/popular')
        ->json()['results'];
        // dump($popularMovies);

        $nowPlayingMovies = Http::withToken(config('services.tmbd.tokens'))
        ->get('https://api.themoviedb.org/3/movie/now_playing')
        ->json()['results'];


        $genres = Http::withToken(config('services.tmbd.tokens'))
        ->get('https://api.themoviedb.org/3/genre/movie/list')
        ->json()['genres'];

        // $genresArray = Http::withToken(config('services.tmbd.tokens'))
        // ->get('https://api.themoviedb.org/3/genre/movie/list')
        // ->json()['genres'];
        // // dump($genresArray);
        // //The below code is very usefull to take values as key-pairs.
        // $genres = collect($genresArray)->mapWithKeys(function ($genre){
        //     return [$genre['id'] => $genre['name']];
        // });
        // dump($genres);
        
        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres,
        );


        // return view('index', [
        //     'popularMovies' => collect($popularMovies)->take(20),
        //     'nowPlayingMovies' => collect($nowPlayingMovies)->take(10),
        //     'generes' =>$genres,
        // ]);
        
        return view('movies.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmbd.tokens'))
        ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
        ->json();
        //dump($movie);
        $viewModel = new MovieViewModel(
            $movie
        );
        return view('movies.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
