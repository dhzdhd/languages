# Kotlin

## Hello World

```kotlin
fun main() {
	println("Hello World")
}
```

- `fun` for declaring functions
- `main` is the entry point

## Variables

``` kotlin
// Readonly (Better)
val popcorn = 5

// Mutable
var hi = 5
hi = 6

// Declaring without initialising
val d: Int
d = 3
```

- Top level variables can be defined
- Kotlin does type inference in var declarations
- ![[./images/kt_types.png]]

## Strings

```kotlin
// Defn
val a = "hi"
a[1] // Indexing

// Iteration
for c in a {
	println(c)
}

// Concatenation
b = "hello"
a + b

// Literals
val s = "hi\n" // Escaped string
val text = """hi""" // Raw string

// String templates
println("Hello $popcorn ${popcorn + 1}")
```

- Strings are represented by the type `String`
- They are immutable
- `${}` used to evaluate an expression inside a string
