<?php
  declare(strict_types=1);

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


    public static function get(string $format)
    {
      if (!isset(self::$attributeFormats[$format]))
      {
        $format = "";
      }

      return new AttributeFormat(...self::$attributeFormats[$format]);
    }
  }
