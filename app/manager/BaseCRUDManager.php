<?php

namespace Absolute\Manager;

use Nette\Database\Context;

class BaseCRUDManager
{
  /** @var Nette\Database\Context */
  protected $database;

  public function __construct(Context $database)
  {
    $this->database = $database;
  }  
}