<?php

/**
 * The helper class, containing all kinds of useful functions that don't really have a better place.
 */
class Helper
{
  /**
   * Print a nice representation of an array.
   */
  static function printr($array)
  {
    echo '<pre>' . print_r($array, true) . '</pre>';
  }

  /**
   * Checks a list of POST variables. 
   *
   * Checks each key for both existance, and non-emptyiness.
   */
  static function available()
  {
    foreach (func_get_args() as $key)
      if (!isset($_POST[$key]) || empty($_POST[$key]))
        return false;
    return true;
  }

  /**
   * Show an informational message.
   */
  static function message($message)
  {
    global $template_vars;
    $template_vars['messages'][] = $message;
  }

  /**
   * Show an error message.
   */
  static function error($error)
  {
    global $template_vars;
    $template_vars['errors'][] = $error;
  }

  /**
   * Redirect to another page.
   *
   * Redirects immediately, ending the current script execution.
   */
  static function redirect($url, $arguments = array())
  {
    if (substr($url, 0, 1) == '@')
    {
      global $router;
      $url = $router->generate(substr($url, 1), $arguments);
    }

    header("location: $url");
    die();
  }

  /**
   * Login an user.
   */
  static function login($user)
  {
    $_SESSION['user'] = $user->getID();
  }

  /**
   * Logout the current user.
   */
  static function logout()
  {
    session_destroy();
  }

  /**
   * Return the currently logged in user.
   */
  static function getUser()
  {
    return isset($_SESSION['user']) ? UserQuery::create()->findOneById($_SESSION['user']) : false;
  }
}
