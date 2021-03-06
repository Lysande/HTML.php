<?php

  declare(strict_types=1);

  /**
   * Lib for generating HTML code,
   * inspired by Elm.
   */

  include "AttributeFormatFactory.php";
  include "ElementType.php";

  abstract class Html
  {
    const ERROR_UNKNOWN_ELEMENT = 'Could not recognize element name';

    public static function __callStatic(string $element, $arguments)
    {
      $type = ElementType::for($element);

      if ($type === null)
      {
        throw new Exception(self::ERROR_UNKNOWN_ELEMENT);
      }

      $args = array_merge([$element], $arguments);
      $method = $type === ElementType::EMPTY_ELEMENT ? 'emptyElement' : 'element';

      return call_user_func_array(['self', $method], $args);
    }

    /**
     * Generic methods.
     */
    protected static function generateElementTemplate(string $tag, int $isEmpty = 0x0): string
    {
      if ($isEmpty == ElementType::EMPTY_ELEMENT)
      {
        return "<$tag%s>";
      }

      return "<$tag%s>%s</$tag>";
    }

    protected static function generateAttributes(array $attributes, string $format = ""): string
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

    /**
     * Creates a element
     * @param  [type] $attributes [description]
     * @param  [type] $children   [description]
     * @return [type]             [description]
     */
    public static function element(string $tagName, array $attributes = [], ...$children): string
    {
      $element = self::generateElementTemplate($tagName);
      $attributes = self::generateAttributes($attributes);
      $children = implode(" ", $children);

      if (!!strlen($attributes))
      {
        $attributes = " $attributes";
      }

      return sprintf($element, $attributes, $children);
    }
    /**
     * Self-Closing element
     * @param  [type] $attributes [description]
     * @return [type]             [description]
     */
    public static function emptyElement(string $tagName, array $attributes = []): string
    {
      $element = self::generateElementTemplate($tagName, ElementType::EMPTY_ELEMENT);
      $attributes = self::generateAttributes($attributes);

      if (!!strlen($attributes))
      {
        $attributes = " $attributes";
      }

      return sprintf($element, $attributes);
    }
  }
