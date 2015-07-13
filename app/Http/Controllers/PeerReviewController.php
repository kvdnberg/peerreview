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

        JavaScript::put([
           'storeAjaxRoute' =>  url('saveReviewBoard')
        ]);

        $columns = ['author' => 'Authors', 'reviewer' => 'Reviewers'];

        return view('PeerReview.index', compact('types', 'columns'));
    }

    public function store()
    {
        $input = Request::all();

        //$data = $input['data'];
    }
}
