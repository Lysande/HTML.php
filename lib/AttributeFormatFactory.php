<?php

include "AttributeFormat.php";

class AttributeFormatFactory
{

  protected static $attributeFormats =
  [
    "style" => ["%k: %v;", " "],
    "srcset" => ["%v %k", ", "],
    "sizes" => ["%k %v", ", "],
    "" => ["%k=\"%v\"", " "]
  ];


  public static function get($format = "")
  {
    if (!isset(self::$attributeFormats[$format]))
    {
      $format = "";
    }

    return new AttributeFormat(...self::$attributeFormats[$format]);
  }
}
