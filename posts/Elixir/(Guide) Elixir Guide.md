# Elixir Guide

## Variables & Types

```elixir
# Types
1       # Integer
0x1F
0b01
0o77
1.0     # Float (64 bit precision)
1.0e10
true    # Boolean
:atom   # Atom / Symbol
"str"   # String
[1, 2]  # List
{1, 2}  # Tuple

# String interpolation
string = "world"
"hello #{string}"
```

- Atoms
	- Atoms (`:hello`) - also called symbols - is a constant whose value is its own name
	- They are usually used to represent the state of an operation (`:ok`, `:error`)
	- The booleans `true` and `false` along with `nil` are atoms. Elixir allows users to not prepend `:` to these
- Strings
	- Are UTF-8 based
	- Interpolation allows any datatype
	- Represented internally by contiguous sequences of bytes known as **binaries**.
	- To get the byte amount, use `byte_size` and to get the actual string length, use `String.length`

## Operators

```elixir
# Relational operators
:atom == :atom  # true
1 != 1
1 < 2
2 > 1
1 <= 1
1 >= 1

# Strict comparison
1 == 1.0   # true
1 === 1.0  # false

# Logical operators
true or true    
true and false
not true

# Additional nil-supported logical operators
1 || true
nil && true
!nil

# Concatenation
"hello" <> "world"
```

- `or` and `and` are short-circuit operators
- `false` and `nil` are considered falsy, everything else, even `""`, `0` are truthy
- Comparison operators perform [structural comparison](https://hexdocs.pm/elixir/Kernel.html#module-structural-comparison) and not the semantic sort

## Functions

```elixir
# Function calling
div(10, 2)
div 10, 2  # Parentheses not required

```

## Collections

```elixir
# Lists
list = [1, 2, true, 3]
[1, 2] ++ [3, 4]  # Concatenation
[1, 2] -- [1]     # De-concatenation
hd(list)   # 1
tl(list)   # [2, true, 3]
[11, 12, 13]  # ~c"\v\f\r"

# Tuples
{:ok, "hello"}
```

- Lists
	- Values can be of any type
	- They are immutable. Hence, (de)concatenation returns a new list
	- When a list of ASCII numbers are seen, Elixir will print it as a charlist
	- Internally are stored as linked lists
- Tuples
	- Values can be of any type
	- Internally stores elements contiguously in memory
	- They are also immutable