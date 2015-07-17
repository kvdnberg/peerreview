<?php

namespace App\Http\Controllers;

use App\Developer;
use App\PeerReview;
use App\Type;
use App\Level;
use App\Skill;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

class DevelopersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $sortby
     * @param string $order
     * @return \Illuminate\View\View
     */
    public function index($sortby = 'firstName', $order = 'asc')
    {

        if ($sortby && $order) {
            $developers = Developer::orderBy($sortby, $order)->get();
        } else {
            $developers = Developer::all();
        }


        return view('PeerReview.Developers.index', compact('developers', 'sortby', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $types = Type::lists('type', 'id');
        $levels = Level::lists('level', 'id');
        $skills = Skill::lists('skill', 'id');
        $developer = new Developer;
        return view('PeerReview.Developers.add', compact('types', 'levels', 'skills', 'developer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Request::all();
        $developer = Developer::create($input);

        $levels = Request::input('levels');
        $developer->levels()->attach($levels);
        $skills = Request::input('skills');
        $developer->skills()->attach($skills);

        return redirect('developers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //TODO? Not sure it's necessary 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $types = Type::lists('type', 'id');
        $levels = Level::lists('level', 'id');
        $skills = Skill::lists('skill', 'id');
        $developer = Developer::find($id);
        return view('PeerReview.Developers.edit', compact('types', 'levels', 'skills', 'developer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        /** @var Developer $developer */
        $developer = Developer::find($id);
        $input = Request::all();
        $developer->update($input);

        //clear the current levels in case something was deselected
                $developer->levels()->detach(Level::all()->lists('id'));
        $levels = Request::input('levels');
        $developer->levels()->attach($levels);

        //clear the current skills in case something was deselected
        $developer->skills()->detach(Skill::all()->lists('id'));
        $skills = Request::input('skills');
        $developer->skills()->attach($skills);


        $developer->save();

        return redirect('developers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //TODO
    }
}
