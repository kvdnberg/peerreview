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
        $boardDevelopers = [];
        $columnIndices = [];

        /** @var PeerReview $board */
        foreach($boards as $board) {
            $type = Type::find($board->type_id);
            $boardDevelopers[$type->slug] = $board->getBoardDevelopers();

            /* Not too elegant way to calculate where to split the list into two columns */
            $developerCount = $board->getDeveloperCount();
            $split = round($developerCount/2, 0, PHP_ROUND_HALF_DOWN);
            $columnIndices[$type->slug] = [0 => $split, $split+1 => $developerCount];
        }


        $columns = ['author' => 'Authors', 'reviewer' => 'Reviewers'];

        return view('PeerReview.index', compact('boardDevelopers', 'developerCount', 'types', 'columns', 'columnIndices'));
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

            //set the other boards as non-current
            $currentBoards = PeerReview::where('current', '=', true)->where('type_id', '=', $type->id)->get();
            foreach($currentBoards as $currentBoard) {
                $currentBoard->current = false;
                $currentBoard->save();
            }

            $peerReview->type_id = $type->id;
            $peerReview->board = $boardString;
            $peerReview->current = true;

            $peerReview->save();
        }



        //$data = $input['data'];
    }


}
