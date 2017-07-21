<?php

require_once(__DIR__ . '/../src/SpaceTools.php');

use Spaceboy\SpaceTools;

var_dump(SpaceTools::arrayIsAssoc([0, 1, 2])); // FALSE
var_dump(SpaceTools::arrayIsAssoc(['foo', 'bar', 'baz'])); // FALSE
var_dump(SpaceTools::arrayIsAssoc([0 => 'foo', 1 => 'bar', 2 => 'baz'])); // FALSE
var_dump(SpaceTools::arrayIsAssoc([0 => 'foo', 2 => 'bar', 1 => 'baz'])); // FALSE
var_dump(SpaceTools::arrayIsAssoc([1 => 'foo', 2 => 'bar', 3 => 'baz'])); // TRUE
var_dump(SpaceTools::arrayIsAssoc(['foo' => 'foo', 'bar' => 'bar', 'baz' => 'baz'])); // TRUE
var_dump(SpaceTools::arrayIsAssoc([])); // FALSE
