<?php
// Include extensions
include __DIR__ . DS . 'extensions' . DS . 'field-methods.php';
include __DIR__ . DS . 'extensions' . DS . 'filters.php';
include __DIR__ . DS . 'extensions' . DS . 'page-methods.php';
include __DIR__ . DS . 'extensions' . DS . 'pages-methods.php';

include __DIR__ . DS . 'core' . DS . 'vote.php';
include __DIR__ . DS . 'core' . DS . 'blacklist.php';
include __DIR__ . DS . 'core' . DS . 'validate.php';
include __DIR__ . DS . 'core' . DS . 'language.php';

// Include hooks, options and routes
include __DIR__ . DS . 'hooks.php';
include __DIR__ . DS . 'routes.php';

// Register fields
$kirby->set('field',  'ratings', __DIR__ . DS . 'fields' . DS . 'ratings');
$kirby->set('blueprint', 'fields/rating_hidden', __DIR__ . DS . 'blueprints' . DS  . 'fields' . DS . 'hidden.yml');

// Register snippets
$kirby->set('snippet', 'ratings-modal', __DIR__ . '/snippets/modal.php');
$kirby->set('snippet', 'rating-panel-stars', __DIR__ . '/snippets/panel-stars.php');
$kirby->set('snippet', 'rating-stars', __DIR__ . '/snippets/stars.php');