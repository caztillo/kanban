<?php namespace Services\Validation;

# app/services/validation/ValidationServiceProvider.php
 
use Illuminate\Support\ServiceProvider;
 
class ValidationServiceProvider extends ServiceProvider {
 

    public function boot()
	{
	    // All your other boot stuff in here...

	    $this->app['validator']->resolver(function($translator, $data, $rules, $messages)
	    {
	        return new CustomValidator($translator, $data, $rules, $messages);
	    });
	}

	public function register(){}
 
}