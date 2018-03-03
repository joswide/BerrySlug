<?php
	
declare(strict_types=1);

namespace BerrySlug;

class Slug{
	
	protected $append_prefix = '-';
	
	public function __construct(){
		
	}
	
	
	/**
	*	Return the append 
	*
	*	@return string
	*
	*/
	public function getAppendPrefix() {
		return $this->append_prefix;
	}
	
	
	/**
	*
	*	@param string $string String to slug
	*	@param callable $callback Callback to verify if slug is available
	*
	*
	*	@return string
	*
	*/
	public function slug($string, $callback = null){
		
		if (!$callback){
			return $this->stringToSlug($string, 0);
		}
		
		$i = 0;
		
		do{
			$slug = $this->stringToSlug($string, $i);
			
			$i++;
		}while(!$this->isAvailableSlugByCallable($slug, $callback));
		
		
	    return $slug;
	}
	
	
	/**
	*
	*	@param string $string String to slug
	*
	*
	*	@return string
	*
	*/
	public function stringToSlug($string, $indice = 0) {
		
		$string = trim($string);
		
		$slug = mb_strtolower($string, "UTF-8");
		
	    $b = ["á","é","í","ó","ú","ä","ë","ï","ö","ü","à","è","ì","ò","ù","ñ"," ",",",".",";",":","¡","!","¿","?",'"',"/","%","&", "(", ")"];
	    $c = ["a","e","i","o","u","a","e","i","o","u","a","e","i","o","u","n","-","","","","","","","","",'',"-","","", "", ""];
		
		$slug = str_replace($b,$c,$slug);
		    
		// only allow following characters:
		// a-z 0-9 _ - .
		$slug = preg_replace("/[^a-z0-9\_\-.]/", "", $slug);
		
		if ($indice > 0){
			$slug = $slug . $this->getAppendPrefix() . $indice;
		}
		    
	    return $slug;
	}
	
	/**
	*	isAvailableSlugByCallable
	*
	*	@param string 	$slug String to availableability verify
	*	@param callable $callable Callable
	*
	*/
	public function isAvailableSlugByCallable($slug, $callable){
		
		
		if (is_callable($callable)){
			
			$responseIsAvailable = call_user_func_array($callable, [$slug]);
			
			return $responseIsAvailable;
			
		}
		
		
		return true;
	}
	
	
	
	
}