# The Gleam Tour

https://tour.gleam.run/everything/

## Types

```rust
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
let add = 1.0 +. 1.5  // Different ops for Float due to absence of overloading
let sci = 1.01e3
```

- Gleam has no implicit conversions nor does it have a null type
- Under the hood Strings are UTF-8 encoded binaries and can contain any valid unicode.
- While written in the code using a capital letter, they are represented at runtime with the atoms `true` and `false`, making them compatible with Elixir and Erlang's booleans.
- `Int` and `Float` have a different set of operators, `Float` ops are suffixed by a `.`
- `Nil` is not a valid value of any other types. If the type of a value is `Nil` then it is the value `Nil`.

## Variables

```rust
// Variables
let x = 1
let x: Int = 1
let _x = 5  // Discarded var

// Constants
const ints: List(Int) = [1, 2, 3]

// Blocks
let value: Bool = {
    "Hello"
    42 + 12
    False
}
```

- Variables by default are immutable and can be shadowed.
- Constants should be literals, not function calls.
- These annotations are optional and while they are checked, they do not aid the type checker. Gleam code is always fully type checked with or without type annotations. (Type inference)
- Every block in Gleam is an expression. All expressions in the block are executed, and the result of the last expression is returned.
- Equality is structurally checked, not by reference

## Collections

```rust
// Lists
let x = [1, 2, 3]
let y = [1, ..[2, 3]]  // Prepending

// Tuples
let x: #(Int, String, List(Int)) = #(1, "hi", [2])
let y = x.0
```

- Lists are ordered, immutable single-linked lists and hence, List is not the right data structure to index into or for a length count.
- Prepending to a list does not change the original list. Instead it efficiently creates a new list with the new additional element.
- Tuples are heterogenous collections.

## Modules

```rust
import gleam/io
import gleam/io.{println}  // Unqualified
import gleam/string as text
import gleam/string_builder.{type StringBuilder}  // Type import

pub type SB =      // Type alias
	StringBuilder

io.println("")
```

- [`gleam/io`](https://hexdocs.pm/gleam_stdlib/gleam/io.html) is in a file called `io.gleam` in a directory called `gleam`
- Unlike functions, Gleam types are commonly imported in an unqualified way.
- A type follows PascalCase

## Case exprs

```rust
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
	[1] | [2] -> 2
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

- Case/Pattern matching is exhaustive in Gleam 
- There is no `if-else` in gleam, `case` is used for every conditional expr.
- Gleam has no loops, instead recursion is used with inbuilt tail call optimisation

## Functions

```rust
// Defn
pub fn add(x: Int, y: Int) -> Int {
  x + y
}
pub fn twice(f: fn(t) -> t, x: t) -> t {  // Generics + fn types
	f(f(x))
}

// Pipes
string
|> string_builder.from_string
|> string_builder.reverse
|> string_builder.to_string

// Labelled args
pub fn replace(
  in string: String,
  each pattern: String,
  with replacement: String,
) {
  // The variables `string`, `pattern`, and `replacement` are in scope here
}
replace(in: "A,B,C", each: ",", with: " ")
replace("A,B,C", ",", " ")  // Can still use positional

// Anon fns / Closures
let add = fn(x, y) { x + y }  // Normal fn without identifier

// Function capturing
pub fn add(x, y) { x + y }
pub fn run() {
  let add_one = add(1, _)  // Kind of like partial fns
  let add_one = fn(x) { add(1, x) }  // Another way of writing
  add_one(2)
}

// Piping
1 |> add(_, 3)
1 |> add(3)  // Both do the same thing

```

- Named functions defined using `pub fn` and they are first class.
- Pipe operator passes the result of one function to the arguments of another function.
- The Gleam compiler can infer all the types of Gleam code without annotations and both annotated and unannotated code is equally safe.
- User defined Type variables can be named anything, but the names must be lower case and may contain underscores.
- Function capturing provides a shorthand syntax for creating anonymous functions that take one argument and call another function. The `_` is used to indicate where the argument should be passed.
- Piping
	- The pipe operator takes the result of the expression on its left and passes it as an argument to the function on its right.
	- The pipe operator will first check to see if the left hand value could be used as the first argument to the call, e.g. `a |> b(1, 2)` would become `b(a, 1, 2)`
	- If not it falls back to calling the result of the right hand side as a function , e.g. `b(1, 2)(a)`.

## Custom types

```rust
// Defn
pub type Cat {  // Type name Cat
  Cat(name: String, cuteness: Int)  // Constructor Cat with 2 fields (A struct/record)
}
pub type Season {  // Enum of sorts
	Spring
	Summer
}
let cat1 = Cat(name: "Nubi", cuteness: 2001)
let cat2 = Cat("Nubi", 2001)

// Multiple constructors
pub type Bool {
  True(msg: String)
  False
}

// Accessors
let cat = Cat("ABC", 2)
cat.name

// Pattern matching
case lucy {
	Starfish(_, favourite_color) -> io.debug(favourite_color)
	Jellyfish(name, ..) -> io.debug(name)
}

// Updating records
let teacher1 = Teacher(name: "Mr Dodd", subject: "ICT", floor: 2, room: 2)
let teacher2 = Teacher(..teacher1, room: 6)

// Generic custom types
pub type Option(inner) {
	Some(inner)
	None
}
```

- Gleam's custom types are named collections of keys and values. They do not have methods.
- Custom types can be defined with multiple constructors, making them a way of modeling data that can be one of a few different variants which can hold data in them. (Union in F# / Enum in rust)

## Advanced features

```rust

```