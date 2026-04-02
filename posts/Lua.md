# Lua

## Getting Started

```lua
print("Hello World")
a = io.read("*n") -- read a number

-- Chunks
dofile("a.lua") -- immediately exec a file (usually used in interactive mode)

-- Semicolons
a = 1; b = a * 2
a = 1 b = a * 2 -- ugly, but valid

-- Variables
b -- nil by default, can be used uninitialised

-- Types
type(nil) --> nil
type(true) --> boolean
type(10.4 * 3) --> number
type("Hello world") --> string
type(io.stdin) --> userdata
type(print) --> function
type(type) --> function
type({}) --> table
type(type(X)) --> string (no matter value of X)
```

- Lua provides a REPL
	- `lua -i prog` starts the interactive REPL after executing `prog` contents
- We call each piece of code that Lua executes, such as a file or a single line in interactive mode, a chunk. A chunk is simply a sequence of commands (or statements).
- Identifiers (or names) in Lua can be any string of letters, digits, and underscores, not beginning with a digit; for instance
	- Identifier starting with `_` are dummy vars
- Semicolons can be used as delimiters but not needed
- Lua is dynamically typed                 