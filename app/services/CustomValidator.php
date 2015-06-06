<?php namespace Services\Validation;
 
class CustomValidator extends \Illuminate\Validation\Validator  {
 
  public function validateAlphaSpace($attribute, $value, $parameters)
  {
    $value = trim($value);
    $value = preg_replace('/\s+/', ' ', $value);

    if(preg_match("/^([a-zA-Z\p{L}]+\s?)+$/u", $value))
    {
      return true;
    }
   
    return false;
  }

  public function validateAlphaNumSpace($attribute, $value, $parameters)
  {
    if(preg_match("/^([a-zA-Z0-9\p{L}]+\s?)+$/u", $value))
    {
      return true;
    }
   
    return false;
  }

  public function validateInArray($attribute, $value, $parameters)
  {

    $array = unserialize(base64_decode($parameters[0]));

    if($array !== array_keys($array))
    {
      //Arreglo asosiativo
      return array_key_exists($value, $array);
    }
    else
    {
      
      return in_array($value, $array);
    }

    

  }

  public function validateInArrayArray($attribute, $value, $parameters)
  {

    $array = unserialize(base64_decode($parameters[0]));

    foreach ($value as $val) 
    {
      if(!in_array($val, $array))
        return false;
    }

    return true;

  }

  public function validateMaxAdd($attribute, $value, $parameters)
  {

    if($value <= $this->data[$parameters[0]] + 1)
    {
      return true;
    }
   
    return false;
  }

  public function validateRequiredIfAttribute($attribute, $value, $parameters) 
  {

      $required = false;

      switch($parameters[1]) 
      {

          case '==':
              $required = $this->data[$parameters[0]] == $parameters[2];
              break;
          case '!=':
              $required = $this->data[$parameters[0]] != $parameters[2];
              break;
          case '===':
              $required = $this->data[$parameters[0]] === $parameters[2];
              break;
          case '!==':
              $required = $this->data[$parameters[0]] !== $parameters[2];
              break;
          case '<':
              $required = $this->data[$parameters[0]] < $parameters[2];
              break;
          case '<=':
              $required = $this->data[$parameters[0]] <= $parameters[2];
              break;
          case '>':
              $required = $this->data[$parameters[0]] > $parameters[2];
              break;
          case '>=':
              $required = $this->data[$parameters[0]] >= $parameters[2];
              break;
      }

      //dd($parameters);

      return $required ? $this->validateRequired($attribute, $value) : true;

  }

}