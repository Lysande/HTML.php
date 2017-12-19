<?php

  include "lib/Html.php";

  echo Html::emptyElement("!doctype html");
echo "\n";echo "\n";
   echo Html::element(
    "div",
    [
      "class" => "my-div",
      "style" => ["color" => "red", "font-size" => "14px"]
    ],
    Html::element("h1", ["class" => "main-heading"], "Välkommen!")
  );
echo "\n";
echo "\n";
  echo Html::emptyElement(
    "img",
    [
      "class" => "my-img",
      "srcset" =>
      [
        "2x" => "logo-large",
        "4x" => "logo-ultra"
      ],
      "sizes" =>
      [
        "(min-width: 600px)" => "200px",
        "" => "50vw"
      ]
    ]
  );
echo "\n";echo "\n";
  echo Html::div();
  echo "\n";echo "\n";
  echo Html::div(["id" => "my-div"]);
  echo "\n";echo "\n";
  echo Html::div(["style" => ["color" => "red"]]);
?>
