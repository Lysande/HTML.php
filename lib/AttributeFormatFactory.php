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
    $format = self::$attributeFormats[$format];

    return new AttributeFormat($format[0], $format[1]);
  }
}
