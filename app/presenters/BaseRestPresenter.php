<?php

namespace Absolute\Presenter;

use Absolute\Response\JsonResponse;

class BaseRestPresenter extends BasePresenter
{
  /** @var property */
  protected $jsonResponse;

  public function startup() 
  {
    parent::startup();

    $this->jsonResponse = new JsonResponse;
  }

  public function getJsonResponse()
  {
    return $this->jsonResponse;
  }
}