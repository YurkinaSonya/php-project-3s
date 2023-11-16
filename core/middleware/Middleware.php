<?php

namespace core\middleware;

use core\http\Request;
use core\http\Response;
use core\Route;

interface Middleware
{

    public function handle(Route $route, Request $request) : Response | null;

}