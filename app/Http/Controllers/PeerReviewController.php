<?php

namespace App\Http\Controllers;

use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;
use App\Models\Developer;
use App\Models\Type;
use App\Models\PeerReview;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;
use Request;

class PeerReviewController extends BaseController
{
    /**
     * Shows the current review boards (frontend/backend)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $types = Type::all();
        $boards = PeerReview::where('current', '=', true)->get();

        $columns = ['author' => 'Authors', 'reviewer' => 'Reviewers'];

        return view('PeerReview.index', compact('boards', 'types', 'columns'));
    }

    /**
     * Edit the review boards. If $id = null, it's a new board.
     * Boards are never updated, so editing an existing board only loads that board's state, allowing you to edit it and save it as new.
     * Old boards are saved for historic reference, so they shouldn't be edited/updated.
     *
     * @param null $id
     * @return \Illuminate\View\View
     */
    public function edit($id = null)
    {
        $types = Type::all();

        $oldBoards = PeerReview::orderBy('created_at', 'DESC')->get();

        JavaScript::put([
           'storeAjaxRoute' =>  url('saveReviewBoard')
        ]);

        $columns = ['author' => 'Authors', 'reviewer' => 'Reviewers'];

        return view('PeerReview.edit', compact('types', 'columns', 'oldBoards'));
    }

    /**
     * AJAX call to store the current board state
     * POST data contains a stringified JSON array i.e. jsonArray['frontend'][0]['author'] = 7 (devId) which is stored in the database
     *
     * The new board is automatically made the current board.
     *
     */
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
                $currentBoard->current_to = new \DateTime();
                $currentBoard->save();
            }
            $peerReview->current_from = new \DateTime();
            $peerReview->type_id = $type->id;
            $peerReview->board = $boardString;
            $peerReview->current = true;

            $peerReview->save();
        }
    }
}
