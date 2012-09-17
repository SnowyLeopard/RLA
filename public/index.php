<?php

require_once '../bootstrap.php';

$posts = AchievementQuery::create()->find();

//printr($posts);
foreach ($posts as $post)
{
  echo printr($post->toArray());
  echo $post->getCategory()->getName();
}
