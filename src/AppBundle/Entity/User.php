<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

	class User extends BaseUser
	{
	    protected $id;
	    protected $username;
	    protected $email;
	    protected $plainPassword;
	    protected $enabled;
	    protected $salt;
	    protected $roles;


	}
