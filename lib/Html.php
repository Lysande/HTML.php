<?php


  /**
   * Lib for generating HTML code,
   * inspired by Elm.
   */

  include "AttributeFormatFactory.php";

  class Html
  {
    const SELF_CLOSING_TAG = 0x1;

    protected static function generateTagTemplate($tagName, $isSelfClosing = 0x0)
    {
      if ($isSelfClosing == self::SELF_CLOSING_TAG)
      {
        return "<$tagName %s>";
      }

      return "<$tagName %s>%s</$tagName>";
    }

    protected static function generateAttributes($attributes, $format = "_")
    {
      $format = AttributeFormatFactory::get($format);

      $attributes = array_map(function ($v, $k) use($format) {
        if (is_array($v))
        {
          /**
           * If the value is an array, we need to expand that into
           * an attribute string by recursing it.
           *
           * $v is the array we want to stringify
           * $k is the current key, which we send along to help determine
           * the pattern for the attributes, as patterns are derived from
           * parent context.
           *
           * "Style" or "srcset" are patterns, "color" is not a pattern.
           */
          $child_attributes = $v;
          $child_format = $k;
          $v = self::generateAttributes($child_attributes, $child_format);
        }



        return str_replace(["%k", "%v"], [$k, $v], $format->getPattern());
      }, $attributes, array_keys($attributes));

      return implode($format->getCombinator(), $attributes);
    }

    protected static function generateChildren($children = [])
    {
      var_dump($children);
      return implode(" ", $children);
    }

    /**
     * Creates a tag
     * @param  [type] $attributes [description]
     * @param  [type] $children   [description]
     * @return [type]             [description]
     */
    public static function tag($tagName, $attributes = [], $children = [])
    {
      $tag = self::generateTagTemplate($tagName);
      $attributes = self::generateAttributes($attributes);
      $children = self::generateChildren($children);

     return sprintf($tag, $attributes, $children);
    }
    /**
     * Self-Closing tag
     * @param  [type] $attributes [description]
     * @return [type]             [description]
     */
    public static function sctag($tagName, $attributes = [])
    {
      $tag = self::generateTagTemplate($tagName, self::SELF_CLOSING_TAG);
      $attributes = self::generateAttributes($attributes);

      return sprintf($tag, $attributes);
    }
  }
