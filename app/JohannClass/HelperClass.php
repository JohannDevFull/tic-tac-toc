<?php

namespace App\JohannClass;


class HelperClass
{




	public function session_create_random_id($desired_output_length, $bits_per_character)
	{
	    $bytes_needed = ceil($desired_output_length * $bits_per_character / 8);
	    $random_input_bytes = random_bytes($bytes_needed);
	   
	    // Lo siguiente se traduce de la función bin_to_readable en la fuente de PHP (ext/session/session.c)
	    static $hexconvtab = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ,-';
	   
	    $out = '';
	   
	    $p = 0;
	    $q = strlen($random_input_bytes);
	    $w = 0;
	    $have = 0;
	   
	    $mask = (1 << $bits_per_character) - 1;

	    $chars_remaining = $desired_output_length;
	    while ($chars_remaining--) 
	    {
	        if ($have < $bits_per_character) 
	        {
	            if ($p < $q) 
	            {
	                $byte = ord( $random_input_bytes[$p++] );
	                $w |= ($byte << $have);
	                $have += 8;
	            } 
	            else 
	            {
	                break;
	            }
	        }

	        // consume $bits_per_character bits
	        $out .= $hexconvtab[$w & $mask];
	        $w >>= $bits_per_character;
	        $have -= $bits_per_character;
	    }

	    return $out;
	}

}

