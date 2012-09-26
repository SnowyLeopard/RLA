<?php

require_once '../bootstrap.php';

/**
 * Symfony2/Routing, for url routing.
 */
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

// Load the routes from the root directory.
$locator = new FileLocator(array($root));
$loader = new YamlFileLoader($locator);

// Create a request context.
$context = new RequestContext();
$context->fromRequest(Request::createFromGlobals());

// Create the router.
$router = new Router($loader, 'routes.yml', 
  //array('cache_dir' => "$root/.cache"),
  array(),
  $context);

// The routing process.
$q = isset($_GET['q']) ? trim($_GET['q'], '/') : '';
$template_vars = array(
  'messages' => array(), 
  'errors' => array(),
  'current_user' => Helper::getUser(),
  'logged_in' => Helper::getUser() != NULL,
);
function url() 
{
  global $router;
  return call_user_func_array(array($router, 'generate'), func_get_args());
}
$twig->addFunction('url', new Twig_Function_Function('url'));

try
{
  // Let symfony route.
  $route = $router->match('/' . $q);
  
  // Load any needed objects.
  $page = $route['_route'];
  if (strpos($page, '_') && isset($route['id']))
  {
    $class = substr($page, 0, strpos($page, '_'));
    $object = call_user_func(array(ucfirst($class) . 'Query', 'create'))->findPK($route['id']);

    // Check if the object existed. If not, raise an exception resulting in a 404.
    if (!$object)
    {
      throw new ResourceNotFoundException("Requested $class with id ${route['id']} does not exist.");
    }

    // Store the object in the template vars.
    $template_vars[$class] = $object;
  }
  
  // Optionally, execute a handler script/file.
  $fn = $root . '/handlers/' . $page . '.php';
  if (file_exists($fn))
  {
    require_once $fn;
  }

  $fn = $root . '/handlers/' . $page . '-' . $context->getMethod() . '.php';
  if (file_exists($fn))
  {
    require_once $fn;
  }
}

// Page/resource not found... 404.
catch (ResourceNotFoundException $e)
{
  $route = array('_route' => 'error');
  $page = 'error';
  $template_vars['error_code'] = '404';
  $template_vars['error_message'] = 'Page/Resource not found. ' . $e->getMessage();
}

/**
 * Show the page.
 */
$template = $twig->loadTemplate("$page.tpl");
$template->display($template_vars);
