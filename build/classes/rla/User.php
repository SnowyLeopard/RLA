<?php

/**
 * Skeleton subclass for representing a row from the 'users' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.rla
 */
class User extends BaseUser 

  public function setPassword($passwd)
  {
    parent::setPassword(crypt($passwd, $this->generateSalt()));
  }

  public function checkPassword($passwd)
  {
    return crypt($passwd, $this->getSalt()) == $this->getPassword();
  }

  public function generateSalt()
  {
    $salt = '$2y$15$' . sha1(uniqid(rand(), TRUE)) . '$';
    $this->setSalt($salt);
    return $salt;
  }

} // User
