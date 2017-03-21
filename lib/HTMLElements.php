<?php

  trait HTMLElements
  {
    /**
     * HTML tag specifics.
     */

    public static function div($attributes = [], $children = [])
    {
      return self::tag("div", $attributes, $children);
    }
  }
