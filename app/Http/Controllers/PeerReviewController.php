<?php

namespace PeerReview\Http\Controllers;

use Illuminate\Http\Request;
use PeerReview\Developer;
use PeerReview\Type;
use PeerReview\PeerReview;

use PeerReview\Http\Requests;
use PeerReview\Http\Controllers\Controller;

class PeerReviewController extends Controller
{
    public function index()
    {
        $types = Type::all();


        $columns = ['author' => 'Authors', 'reviewer' => 'Reviewers'];

        return view('PeerReview.index', compact('types', 'columns'));
    }
}
