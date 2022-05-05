<?php

	// Ejemplo tomado de: https://styde.net/como-crear-helpers-personalizados-en-laravel
	
	use Illuminate\Http\Request;



	if (! function_exists('current_user')) 
	{
	    function current_user()
	    {
	        return auth()->user();
	    }
	}

	function token_s(Request $request)
    {

        $data = $request->session()->all();

        return $data['_token'];
    } 



