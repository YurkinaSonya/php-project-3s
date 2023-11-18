<?php

require_once 'src/generator.php';

use gen\src\CodeGenerator;

$generator = new CodeGenerator();

$generator->setData(require 'tpl/data.php');

//$generator->generateAll();

$generator->generateDtos();
