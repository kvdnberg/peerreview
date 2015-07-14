<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeerReview extends Model
{
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function getBoardDevelopers()
    {
        $boardDevelopers = [];
        $board = $this->board;
        $board = json_decode($board);
        if($board) {
            foreach ($board as $index => $developers) {
                $boardDevelopers['author'][$index] = Developer::find($developers->author);
                $boardDevelopers['reviewer'][$index] = Developer::find($developers->reviewer);

            }
        }
        return $boardDevelopers;

    }
}
