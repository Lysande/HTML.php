<?php

  include "lib/Html.php";

  echo Html::emptyElement("!doctype html");
  echo Html::html([],
    Html::head([],
      Html::title([], 'Html — Elm-inspired HTML generation library for PHP')
    ),
    Html::body([],
      Html::h1([], 'Welcome!')
    )
  );
