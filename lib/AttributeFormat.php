<?php


  class AttributeFormat
  {
    protected $pattern;
    protected $combinator;

    function __construct($pattern, $combinator)
    {
      $this->pattern = $pattern;
      $this->combinator = $combinator;
    }

    public function getPattern()
    {
      return $this->pattern;
    }

    public function getCombinator()
    {
      return $this->combinator;
    }
  }
