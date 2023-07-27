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
val s = "hi\n" // escaped string
val text = """hi""" // raw string

// String templates
println("Hello $popcorn ${popcorn + 1}")
```

- Strings are represented by the type `String`
- They are immutable
- `${}` used to evaluate an expression inside a string

## Collections

```kotlin
// List
// Defn
val a: List<String> = listOf("a", "b") // read only
val b: MutableList<String> = mutableListOf("e", "f") // mutable
val c: List<String> = b // read only view of b

// Indexing
a[1]
a.first() // extension fn
a.last()

// Methods
a.count()
"a" in a // membership checking
b.add("g")
b.remove("g")

// Set
// Defn
val a: Set<String> = setOf("a", "b", "a") // read only, dupl a is dropped
val b: MutableSet<String> = mutableSetOf("e", "f") // mutable
val c: Set<String> = b // read only view of b

// Methods - same as List

// Map
// Defn
val a = mapOf("apple" to 100, "kiwi" to 190) // read only
println(readOnlyJuiceMenu)
val b: MutableMap<String, Int> = mutableMapOf("apple" to 100) // mutable
println(juiceMenu)

// Indexing
a["apple"]

// Methods
b.put("banana", 100)
b.remove("banana")
b.containsKey("b") // boolean

// Properties
a.keys
a.values
"a" in a.keys // or a.values
```

- ![[./images/kt_collections.png]]

## Control flow

```kotlin
// Cond exprs
// if
if (check) {
} else {
}

if () a else b // No ternary op, if used as an expr

// when (match or switch in other langs)
when (obj) { // used as a statement
	"1" -> println()
	"2" -> println()
	else -> println()
}
val a = when ... // used as expr
val description = when { // match/when guards
    temp < 0 -> "very cold"
    temp < 10 -> "a bit cold"
    temp < 20 -> "warm"
    else -> "hot"             
}

// Ranges
1..4 // 1 to 4 incl
1..<4 // excludes 4
4 downTo 1 step 2 // reverse with 2 step

// Loops
// for
for (a in 1..5) {}

// while
while (a < 3) {}
do {
} while (a < 3)
```

- If `when` is used as an expression, the else branch is mandatory, unless the compiler can detect that all possible cases are covered by the branch conditions.
- Ranges can also be used with chars

## Functions

```kotlin

```