<?php

namespace Absolute\Presenter;

use Nette\Application\UI\Presenter;
use Nette\Security\Permission;

class BasePresenter extends Presenter
{
  /** @var \Absolute\Module\Auth\Manager\UserAuthenticator @inject */
  public $userAuthenticator;

  protected $user;
  protected $httpRequest;
  protected $httpResponse;
  protected $appSession;
  protected $acl;

  public function startup() 
  {
    parent::startup();
    $this->user = $this->getUser();
    $this->httpRequest = $this->getContext()->getByType('Nette\Http\Request');
    $this->httpResponse = $this->getContext()->getByType('Nette\Http\Response');

    $this->httpResponse->setHeader('Access-Control-Allow-Origin', 'http://localhost:3000');
    $this->httpResponse->setHeader('Access-Control-Allow-Credentials', 'true');
    $this->httpResponse->setHeader('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, DELETE, OPTIONS');
    $this->httpResponse->setHeader('Access-Control-Allow-Headers', 'accept, origin, x-requested-with, content-type');
    $this->httpResponse->setHeader('Access-Control-Expose-Headers', 'Access-Control-Allow-Origin');

    $this->acl = new Permission;
    // RESOURCES
    $this->acl->addResource('supervising');
    $this->acl->addResource('administration');
    $this->acl->addResource('backend');
    // ROLES
    $this->acl->addRole('supervisor');
    $this->acl->addRole('admin');
    $this->acl->addRole('user');
    $this->acl->addRole('guest');
    // Supervisor
    $this->acl->allow('supervisor'); // Allow all resources
    // Admin
    $this->acl->allow('admin');
    $this->acl->deny('admin', ['supervising']);
    // User
    $this->acl->deny('user', Permission::ALL);
    $this->acl->allow('user', ['backend']);
    // Guest
    $this->acl->deny('guest', Permission::ALL);
    // 
    $this->user->setAuthorizator($this->acl); 
    $this->user->setAuthenticator($this->userAuthenticator);

    // App Session
    $this->appSession = $this->getSession('app');
  }

  public function getAppSession() 
  {
    return $this->appSession;
  }

  public function getHttpResponse() 
  {
    return $this->httpResponse;
  }

  public function getHttpRequest() 
  {
    return $this->httpRequest;
  }
}