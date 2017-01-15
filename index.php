<?php

  include "lib/Html.php";

  #echo "HTML.php";

  echo Html::sctag("!doctype html");

   echo Html::tag(
    "div",
    [
      "class" => "my-div",
      "style" => ["color" => "red", "font-size" => "14px"]
    ],
    [
      Html::tag("h1", ["class" => "main-heading"], ["Välkommen!"])
    ]
  );


  echo Html::sctag(
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

?>
