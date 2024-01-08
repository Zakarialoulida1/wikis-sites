<?php
class Wiki extends controller{
    private $wiki;
    public function __construct()
    {
        $this->wiki=$this->model('wiki');
    }
    
}