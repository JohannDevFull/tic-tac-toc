<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


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
    	$board_fields_four =[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
    	$board_fields_five =[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

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

        $winners_four=[
            [0,4,8],
            [4,8,12],
            [1,5,9],
            [5,9,13],
            [2,6,10],
            [6,10,14],
            [7,11,15],
            [0,1,2],
            [1,2,3],
            [4,5,6],
            [5,6,7],
            [8,9,10],
            [9,10,11],
            [12,13,14],
            [13,14,15],
            [0,5,10],
            [5,10,15],
            [3,6,9],
            [6,9,12],
        ];

        //Para una proxima version XD
        $winners_five=[
            [0,5,10,15],
            [5,10,15,20],
            [1,6,11,16],
            [6,11,16,21],
            [2,6,10],
        ];


        DB::table('boards_types')->insert([
            'name'      			=>  'Tres',
            'board_fields'     		=>  json_encode($board_fields_three),
            'board_fields_winners'  =>  json_encode($winners_three)
        ]);

        DB::table('boards_types')->insert([
            'name'      			=>  'Cuatro',
            'board_fields'     		=>  json_encode($board_fields_four),
            'board_fields_winners'  =>  json_encode($winners_four)
        ]);

        DB::table('boards_types')->insert([
            'name'      			=>  'Cinco',
            'board_fields'     		=>  json_encode($board_fields_five),
            'board_fields_winners'  =>  json_encode($winners_five)
        ]);
    }
}
