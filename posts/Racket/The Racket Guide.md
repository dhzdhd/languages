# The Racket Guide

[Guide link](https://docs.racket-lang.org/guide/index.html)

## About the language

- Racket is a dialect of the Lisp language and a direct descendant of Scheme
- Consists of the `racket` compiler, interpreter and runtime and `raco` build and package manager

## Values and Definitions

```scheme
; Values
123
#t
"Hello World"

; Definition
(define a 5)           ; Variable
(define (extract str)  ; Procedure
	(substring str 1 3))
(define (extract str)  ; Multi body procedure
	(printf "Substring")
	(substring str 1 3))
(define (extract str)
	substring str 1 3)  ; Always returns 3 due to lack of ()
(define (double v)      ; Procedure application on expressions
	((if (string? v) string-append +) v v))

; Anonymous procedures/functions
(lambda (s) (string-append s "!"))

; Procedure application 
(extract "Hello")  ; el

; Program module definition
#lang racket <topform> 
```

- Values include numbers, booleans, strings and byte strings
- Program module definition starts with a `#lang`, followed by the language and then a topform which can be either a expression or definition
- Definitions can be of two types
	- `(define <id> <expr>)` - binds result of `expr` to `id`
	- `(define (<id> <id>*) <definition>* <expr>+)` - binds first `<id>` to a procedure with the rest being arguments. `<expr>` is the body of the function
- Under the hood, the fn defn is the same as a non fn, it is just a value
- For a multi expression body, the last expression is the result whereas the remaining are evaluated, usually for side effects.
- Procedure application syntax - `(<expr> <expr>*)` wherein the first `expr` is usually an `id` but can also be an `expr` that evaluates to a procedure
- Lambdas
	- `(lambda (<id>*) <definition>* <expr>+)` 
	- Anonymous functions and are also closures due to Racket being a lexically scoped language

## Conditionals

```scheme
; if (an if else)
(if (> a b)
	"a > b"
	"a < b")

; cond (a switch case)
(cond
	[(string-prefix? s "a")
	 "a first"]
	[(string-prefix? s "b")
	 "b first"]
	[else "dunno"])
```

- `(if <expr> <expr> <expr>)` The first `expr` is always evaluated and if it is true, the second is evaluated, else, the third.
	- `if` can be nested to create complex conditions
	- `(and|or <expr>+)` can also be used
- `(cond)` is used as a if-else chain. The `[]` are convention, they are interchangeable with `()`

## Local bindings

```scheme

```

## Useful definitions

```lisp
(enter! "file_name")
```

- `enter!` loads code from the file and switches the evaluation context to the inside of the module.