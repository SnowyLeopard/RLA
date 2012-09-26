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
{
  /** 
   * Set the password for this user.
   *
   * You don't have to worry about hashing or salting, this will be done 
   * auctomatically. Also, a new salt will be generated and stored each time a 
   * new password is set.
   */
  public function setPassword($passwd)
  {
    parent::setPassword(crypt($passwd, $this->generateSalt()));
  }

  /**
   * Check's whether the provided password matches.
   *
   * Since we use hashing and salting and all, simply comparing the password to 
   * getPassword()'s return value won't do.
   */
  public function checkPassword($passwd)
  {
    return crypt($passwd, $this->getSalt()) == $this->getPassword();
  }

  /**
   * Generate a new salt.
   *
   * The salt is generated in a way that the php crypt() function will use blowfish.
   */
  public function generateSalt()
  {
    $salt = '$2y$15$' . sha1(uniqid(rand(), TRUE)) . '$';
    $this->setSalt($salt);
    return $salt;
  }

  /**
   * Permission levels.
   */
  static $LEVELS = array(
    'admin' => 100,
    'mod'   => 50,
    'user'  => 5,
  );

  /**
   * Check whether the user's level is high enough.
   */
  public function hasPermission($level)
  {
    return self::$LEVELS[$this->getLevel()] >= self::$LEVELS[$level];
  }
} // User
