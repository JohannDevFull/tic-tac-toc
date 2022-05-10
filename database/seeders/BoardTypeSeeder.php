<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\TictactocController;

class BoardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

    	$board_fields_three=[0,0,0,0,0,0,0,0,0];
    	$board_fields_five =[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
    	$board_fields_seven =[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
         0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

    	$winners_three=[
            [0,3,6],
            [1,4,7],
            [2,5,8],
            [0,4,8],
            [2,4,6],
            [0,1,2],
            [3,4,5],
            [6,7,8]
        ];

        $winners_five=[
            [0,5,10,15],
            [5,10,15,20],
            [1,6,11,16],
            [6,11,16,21],
            [2,7,12,17],
            [7,12,17,22],
            [3,8,13,18],
            [8,13,18,23],
            [4,9,14,19],
            [9,14,19,24],
            [0,1,2,3],
            [1,2,3,4],
            [5,6,7,8],
            [6,7,8,9],
            [10,11,12,13],
            [11,12,13,14],
            [15,16,17,18],
            [16,17,18,19],
            [20,21,22,23],
            [21,22,23,24],
            [0,6,12,18],
            [6,12,18,24],
            [4,8,12,16],
            [8,12,16,20],
        ];

        $winners_seven=[
            [0,7,14,21],
            [7,14,21,28],
            [14,21,28,35],
            [21,28,35,42],
            [1,8,15,22],
            [8,15,22,29],
            [15,22,29,36],
            [22,29,36,43],
            [2,9,16,23],
            [9,16,23,30],
            [16,23,30,37],
            [23,30,37,44],
            [3,10,17,24],
            [10,77,24,31],
            [17,24,31,38],
            [24,31,38,45],
            [4,11,18,25],
            [11,18,25,32],
            [18,25,32,39],
            [25,32,39,46]
        ];

        DB::table('boards_types')->insert([
            'name'      			=>  'Tres',
            'board_fields'     		=>  json_encode($board_fields_three),
            'board_fields_winners'  =>  json_encode($winners_three)
        ]);


        $winners_five_diagonals=[
            [5,11,17,23],
            [0,6,12,18],
            [6,12,18,24],
            [1,7,13,19]
        ];
        $winners_five = new TictactocController();
        DB::table('boards_types')->insert([
            'name'      			=>  'Cinco',
            'board_fields'     		=>  json_encode($board_fields_five),
            'board_fields_winners'  =>  json_encode($winners_five->winningCombinations( 5, 2 , $winners_five))
        ]);


        $winners_seven_diagonals=[
            [21,24,27,45],
            [14,22,30,38],
            [22,30,38,46],
            [7,15,23,31],
            [15,23,31,39],
            [23,31,39,47],
            [0,8,16,24],
            [8,16,24,32],
            [16,24,32,40],
            [24,32,40,48],
            [1,9,17,25],
            [9,17,25,33],
            [17,25,33,41],
            [17,25,33,41],
            [2,18,18,26],
            [18,18,26,34],
            [3,11,19,27],
        ];
        $winners_seven = new TictactocController();
        DB::table('boards_types')->insert([
            'name'      			=>  'Siete',
            'board_fields'     		=>  json_encode($board_fields_seven),
            'board_fields_winners'  =>  json_encode($winners_seven->winningCombinations( 7,4, $winners_seven_diagonals))
        ]);
    }
}
