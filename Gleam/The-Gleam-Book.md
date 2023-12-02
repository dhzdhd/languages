# The Gleam Book

## Types

```gleam
// Strings
let x = "Hello
Gleam!"
let y = "Hello" <> " World"

// Bool
let x = True
let y = True && False || !False

// Int
let x = 1
let o = 0o7
let b = 0b1
let h = 0xF
let large = 1_000_000
let add = 1 + 5

// Float
let add = 1.0 +. 1.5  // Different ops for Float
let sci = 1.01e3
```

- Under the hood Strings are UTF-8 encoded binaries and can contain any valid unicode.
- While written in the code using a capital letter, they are represented at runtime with the atoms `true` and `false`, making them compatible with Elixir and Erlang's booleans.
- `Int` and `Float` have a different set of operators, `Float` ops are suffixed by a `.`

## Variables

```gleam
// Variables
let x = 1
let x: Int = 1

// Blocks
let value: Bool = {
    "Hello"
    42 + 12
    False
}
```

- Variables by default are immutable and can be shadowed.
- These annotations are optional and while they are checked, they do not aid the type checker. Gleam code is always fully type checked with or without type annotations. (Type inference)
- Every block in Gleam is an expression. All expressions in the block are executed, and the result of the last expression is returned.

## Collections

```gleam
// Lists
let x = [1, 2, 3]
let y = [1, ..[2, 3]]  // Prepending

// Tuples
let x: #(Int, String, List(Int)) = #(1, "hi", [2])
let y = x.0
```

- Lists are ordered, homogeneous collections of values.
- Prepending to a list does not change the original list. Instead it efficiently creates a new list with the new additional element.
- Tuples are heterogenous collections.

## Case exprs

```gleam
// Defn
case some_number {
  0 | 1 -> "Zero"  // Multiple cases should be of same type
  n -> "Some other number"  // Matches anything
}

let description =
  case True {
    True -> "It's true!"
    False -> "It's not true."
  }

// Destructuring
case xs {
	[] -> 0
	[a] if a > 2 -> 1  // Case guard
	[a, b] -> 2
	_ -> 10
}

case xxs {
	[[]] -> 0
	[[], ..] -> 1  // Only 1st element in empty list
	[[a, ..], ..] -> 2
	_ -> 10
}

let [a, b] = [1, 2]

// String matching
case x {
  "Hello, " <> name -> name
  _ -> "other"
}

// Multiple values
case x, y {
  1, 1 -> "both are 1"
  1, _ -> "x is 1"
  _, 1 -> "y is 1"
  _, _ -> "neither is 1"
}

// Name assignment
case xs {
  [[_, ..] as inner_list] -> inner_list
  other -> []
}

```

- There is no `if-else` in gleam, `case` is used for every conditional expr.

## Functions

```gleam

```