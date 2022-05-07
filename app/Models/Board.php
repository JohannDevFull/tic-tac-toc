<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $table = 'boards';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'matchs_id',
        'first_player',
        'board_fields',
        'boards_type_id',
        'ref_player_rerquest',
        'request',
        'response',
        'game_over'
    ];
}
