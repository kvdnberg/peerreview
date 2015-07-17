<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeerReview extends Model
{
    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function getBoardDevelopers()
    {
        $boardDevelopers = [];
        $board = $this->board;
        $board = json_decode($board);
        if($board) {
            foreach ($board as $index => $developers) {
                if(property_exists($developers, 'author')) {
                    $boardDevelopers['author'][$index] = Developer::find($developers->author);
                }
                if(property_exists($developers, 'reviewer')) {
                    $boardDevelopers['reviewer'][$index] = Developer::find($developers->reviewer);
                }

            }
        }
        return $boardDevelopers;

    }

    public function getDeveloperCount()
    {
        $board = $this->board;
        $board = json_decode($board);
        return count((array)$board);
    }
}
