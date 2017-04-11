# html - Write PHP, get HTML

`html` is a small, simple library for HTML markup creation,
inspired by [Elm](http://elm-lang.org/).

```php

Html::article(["class" => "chapter"], [
  Html::header([
    Html::h1(["class" => "chapter__heading"],
      ["Welcome!"]
    ),
  ]),
  Html::div(
    [
      "class" => "chapter__body",
      "style" => ["text-transform" => "uppercase"]
    ],
    ["Lorem ipsum dolor sit amet"]
  )
])

```

## How does it work?

Each HTML element is available as a static method on `Html`, along with
the arbitrary methods `Html::element` and `Html::emptyElement`.

Both `Html::element` and `Html::emptyElement` take a tag name,
followed by attributes. Non-empty elements take a list of children, as well.
Everything gets passed in as arrays, both attributes and children.
Child elements are recursively rendered, and attributes are rendered according
to a predefined ruleset.

The default ruleset is the standard HTML attribute
format, `attribute="value"`.
There are also formats defined for `style`, `sizes` and `srcset`.

## Installation
Clone repo, download and unpackage the files, or
[install via Composer](https://packagist.org/). The package is available
as `lysande/html`.

## In the future
- Allow elements to define children, without attributes
- React-/JSX-like `true/false` for boolean attributes
- Declare singular children without arrays
