<?php

namespace App\Http\Controllers;

use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;
use App\Developer;
use App\Type;
use App\PeerReview;
use Illuminate\Routing\Controller as BaseController;

use App\Http\Requests;
use Request;

class PeerReviewController extends BaseController
{
    public function index()
    {
        $types = Type::all();
        $boards = PeerReview::where('current', '=', true)->get();

        foreach($boards as $board) {
            $type = Type::find($board->type_id);

            $boardDevelopers[$type->slug] = $board->getBoardDevelopers();
        }

        $columns = ['author' => 'Authors', 'reviewer' => 'Reviewers'];

        return view('PeerReview.index', compact('boardDevelopers', 'types', 'columns'));
    }

    public function edit($id = null)
    {
        $types = Type::all();

        JavaScript::put([
           'storeAjaxRoute' =>  url('saveReviewBoard')
        ]);

        $columns = ['author' => 'Authors', 'reviewer' => 'Reviewers'];

        return view('PeerReview.edit', compact('types', 'columns'));
    }

    public function store()
    {
        $input = Request::all();

        $boards = json_decode($input['reviewBoard']);

        foreach($boards as $type_slug => $board) {
            $boardString = json_encode($board);
            $peerReview = new PeerReview();
            $type = Type::where('slug', '=', $type_slug)->first();
            $peerReview->type_id = $type->id;
            $peerReview->board = $boardString;
            $peerReview->current = true;

            $peerReview->save();
        }



        //$data = $input['data'];
    }


}
