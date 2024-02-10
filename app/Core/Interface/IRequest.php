<?php

namespace Core\Interface;


interface IRequest
{
    public function getBody();
    public function getQuery();
    public function getString($name);
    public function getJson($name);
}
