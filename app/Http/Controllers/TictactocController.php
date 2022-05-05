<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Application;


use App\Models\Board;
use App\Models\MatchGame;
use App\Models\Player;

class TictactocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->name="";

        $player=$this->getPlayerSession($request);

        $session_match= $request->session()->has('session_match') ? true : false ;

        return Inertia::render('Welcome', [
            'laravelVersion'    => Application::VERSION,
            'phpVersion'        => PHP_VERSION,
            'player'            => $player,
            'session_match'     => $session_match
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function toPlay(Request $request)
    {
        $shift=0;
        $code           = $this->codeGenerate(6);
        $player         = $this->getPlayerSession( $request);
        
        if( isset( $request->code ) ) 
        {
            $match          = $this->joinMatch( $request->code , $player->id );
            $this->sessionMatch( $request , $match->id );
            $player->guest  = true;
            $request->guest = true;
        }
        else
        {
            $new_m = !isset($request->new_m) ? $new_m=false : $new_m = $request->new_m;

            if ( $new_m == false ) 
            {
                $match=$this->validateOrCreateMatch( $request , $player , $code);
                $this->sessionMatch( $request , $match->id );
            }
            else
            {
                $match=$this->desableAndCreateMatch( $player , $code );
                $this->sessionMatch( $request , $match->id );
            }

            $player->guest  = $player->id == $match->ref_player_one_id ? false : true;
            $request->guest = $player->id == $match->ref_player_one_id ? false : true;
        }

        $another_player=$this->getAnotherPlayerBack($request);

        $shift = $this->shift( $player , $match );

        return Inertia::render('BoardGame', [
            'match'             => $match,
            'shift'             => $shift,
            'code'              => $match->code_match,
            'player'            => $player,
            'another_player'    => $another_player
        ]);
    }

    public function getPlayerSession($request)
    {
        $player=Player::where('token',token_s($request))->get();
        $player= isset($player[0]) ? $player[0] : [];

        if ( !isset($player->id) ) 
        {
            $player=Player::create([
                "name"  => "",
                "token" => token_s($request)
            ]);
        }
        else
        {
            if ($player->name == '') 
            {
                $player->name=$request->name;

                $player->save();
            }
        }

        return $player;
    }

    public function getAnotherPlayerBack( $request )
    {
        # code...
        $code__;
        $session_match = $request->session()->has('session_match') ? $request->session()->get('session_match') : 0 ;
        if($session_match > 0 ){ $match=MatchGame::where('id',$session_match)->get(); $code__= $match[0]->code_match; }
        if ( !empty($code__) ) 
        { 
            $another_player = $this->getAnotherPlayer( $request , $code__ ); 
            
            if (isset($another_player->name)) 
            {
                # code...
                $another_player = $another_player->name ;
            }else
            {
                $another_player = 0 ;
            }
        }
        else
        { 
            $another_player = 0; 
        }
        return $another_player;
    }
    
    public function getAnotherPlayer(Request $request,$code)
    {

        $player=$this->getPlayerSession($request);

        $match=MatchGame::where('code_match',$code)->get();
        $match=$match[0];

        if ($request->guest != true) 
        {
            $player=Player::where( 'id' , $match->ref_player_two_id )->get();
            $player= $match->ref_player_two_id == 0 ? 0 : $player[0]->name ;
        }
        else
        {
            $player=Player::where( 'id' , $match->ref_player_one_id )->get();
            $player=$player[0]->name;
        }

        return $player;
    }

    public function codeGenerate( $longitud ) 
    {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern)-1;

        $array_string=str_split($pattern);
        
        for( $i=0; $i < $longitud; $i++ )
        {
            $key .= $array_string[mt_rand(0,$max)];
        }
        
        return $key;
    }

    public function getInfoUpdateGame( $code , $player )
    {
        $match = MatchGame::where('code_match',$code)->get();
        $board=Board::where( 'match_id' , $match[0]->id )->get();
        
        $match[0]->board = $board[0];

        $match_player = $match[0]->board->shift == 1 ?  $match[0]->ref_player_one_id : $match[0]->ref_player_two_id;
        if( $player == $match_player ){ $result=true; }else{ $result=false; }

        $match[0]->shift_ = $result;

        return $match[0];
    }











    public function play( Request $request  )
    {
        $match = MatchGame::where('code_match', $request->code )->get();
        $board=Board::where('match_id',$match[0]->id)->get();
        $board[0]->board_fields = json_encode($request->board) ;       
        $board[0]->shift = $board[0]->shift == 1 ? 2 : 1;
        $board[0]->save();

        $board[0]->winner = $this->validatePlay( $request->player , $board[0]->board_fields );

        return $board[0];
    }

    public function validatePlay( $player , $boar )
    {
        $player = $player['guest'] == true ? 2 : 1 ;
        $board_fields = json_decode( $boar ) ;
        
        $possible_wins=[
            [0,3,6],
            [1,4,7],
            [2,5,8],
            [0,4,8],
            [2,4,6],
            [0,1,2],
            [3,4,5],
            [6,7,8]
        ];

        $winner=false;
        $sum=0;
        $i=0;

        foreach ($possible_wins as $key ) 
        {
            if ( $board_fields[ $key[0] ] == $player ){ $sum ++;  }
            if ( $board_fields[ $key[1] ] == $player ){ $sum ++;  }
            if ( $board_fields[ $key[2] ] == $player ){ $sum ++;  }
        
            if ( $sum == 3 ) { $winner = true;   }
            
            $sum=0;

            $i ++;
        }

        return $winner;
    }

    public function validateOrCreateMatch( $request , $player , $code )
    {
        $session_match = $request->session()->has('session_match') ? $request->session()->get('session_match') : 0 ;

        // $match=MatchGame::where('ref_player_one_id',$player->id)
        // ->where('state',true)
        // ->orWhere('ref_player_two_id',$player->id)
        // ->where('state',true)
        // ->get();

        $match=MatchGame::where('id',$session_match)
        ->get();

        if( count($match) > 0 ) 
        {
            $board=Board::where('match_id',$match[0]->id)->get();
            $match[0]->board = $board[0];
        }
        else
        {
            $match=MatchGame::create([
                "code_match"        => $code,
                "ref_player_one_id" => $player->id,
                "ref_player_two_id" => 0
            ]);
            $board=Board::create([
                "match_id"      => $match->id,
                "first_player"  => 1,
                "board_fields"  => json_encode([0,0,0,0,0,0,0,0,0])
            ]);
            // $board=$board[0];
            $match->board=$board;
        }

        return $match[0];
    }

    public function desableAndCreateMatch( $player , $code )
    {
        MatchGame::where('ref_player_one_id',$player->id)
        ->orWhere('ref_player_two_id',$player->id)
        ->update(['state' => false]);

        $match=MatchGame::create([
            "code_match"        => $code,
            "ref_player_one_id" => $player->id,
            "ref_player_two_id" => 0
        ]);

        $board=Board::create([
            "match_id"      => $match->id,
            "first_player"  => 1,
            "board_fields"  => json_encode([0,0,0,0,0,0,0,0,0])
        ]);

        $match->board=$board;

        return $match;
    }    

    public function joinMatch( $code , $player )
    {
        $match = MatchGame::where('code_match', $code )->get();

        if( $match[0]->ref_player_two_id == 0 ) 
        {
            $match[0]->ref_player_two_id = $player;
        }else{
            $match[0]->ref_player_one_id = $player;
        }
        
        $match[0]->save();

        $board=Board::where('match_id',$match[0]->id)->get();
        $match[0]->board=$board[0];

        return $match[0];
    }

    public function sessionMatch( $request , $value )
    {
        if ($request->session()->has('session_match')) 
        {
            $request->session()->forget('session_match');
            $request->session()->put('session_match', $value );
        }
        else
        {
            $request->session()->put('session_match', $value );
        }
    }

    public function shift( $player , $match )
    {
        $result;

        $match_player = $match->board->shift == 1 ?  $match->ref_player_one_id : $match->ref_player_two_id;

        if( $player->id == $match_player ){ $result=true; }else{ $result=false; }

        return $result;
    }

    public function test( Request $request )
    {

        $data = $request->session()->all();

        return $data['_token'];
    }

    public function testValidate( )
    {
        $result;

        $player=1;

        $board_fields=[2,0,2,1,1,1,0,1,2];

        $possible_wins=[
            [0,3,6],
            [1,4,7],
            [2,5,8],
            [0,4,8],
            [2,4,6],
            [0,1,2],
            [3,4,5],
            [6,7,8]
        ];

        $winner=false;

        $sum=0;
        $i=0;

        foreach ($possible_wins as $key ) 
        {
            if ( $board_fields[ $key[0] ] == $player ){ $sum ++;  }
            if ( $board_fields[ $key[1] ] == $player ){ $sum ++;  }
            if ( $board_fields[ $key[2] ] == $player ){ $sum ++;  }
        
            if ( $sum == 3 ) { $winner = true;   }
            
            $sum=0;

            $i ++;
        }
            
        
        $test=[
            "test"      => $i,
            "winner"    => $winner
        ];

        dd($test);
    }
}
