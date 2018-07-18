<?php

namespace Absolute\Response;

/**
 * @property any $payload
 */

class JsonResponse 
{
  use \Nette\SmartObject;

  private $payload;

	public function __construct() 
  {
	}

  public function getPayload() 
  {
    return $this->payload;
  }

  // SETTERS

  public function setPayload($payload) 
  {
    $this->payload = $payload;
  }

  // ADDERS

  // OTHER METHODS  

  public function toJson() 
  {
    return $this->payload;
  }
}

