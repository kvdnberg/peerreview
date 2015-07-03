<?php

namespace PeerReview\Http\Controllers;

use PeerReview\Developer;
use PeerReview\DeveloperType;
use PeerReview\Http\Requests;
use PeerReview\Http\Controllers\Controller;
use Request;

class DevelopersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($sortby = null, $order = null)
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
        $types = DeveloperType::lists('type', 'id');
        return view('PeerReview.Developers.add', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Request::all();
        Developer::create($input);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $types = DeveloperType::lists('type', 'id');
        $developer = Developer::find($id);
        return view('PeerReview.Developers.edit', compact('types', 'developer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = Request::all();
        Developer::update($input);

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
        //
    }
}
