<html>
  <head>
    <style type='text/css'>
      div {
        display: none;
        padding-left: 1em;
      }
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  </head>
  <body>

<?php

require_once '../bootstrap.php';

function block($title, $content)
{
  static $id = 0;
  $id++;

  return "<a href='#' onClick=\"$('#block-$id').toggle();\">$title</a><div id='block-$id'>$content</div><br />";
}

function sblock($title, $item)
{
  return block($title, '<pre>' . print_r($item->toArray(), true) . '</pre>');
}

function dump($type)
{
  $items = call_user_func(array("{$type}Query", 'create'))->find();
  $block = '';
  foreach ($items as $key => $item)
  {
    $block .= sblock("$type $key", $item);
  }

  echo block("{$type}s", $block);
}

dump('Category');
dump('Group');
dump('Achievement');
dump('User');
