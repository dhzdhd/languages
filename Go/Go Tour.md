# Go Tour

## Packages

```go
// Package defn
package main

// Imports
import (  // Factored import
	"fmt"
	"math/rand"
)
import "fmt"
import "math/rand"
```

- Every Go program is made of packages
- Programs start running in package `main`
- By convention, the package name is the same as the last element of the import path
- A name is exported (accessible outside a package) if it begins with a capital letter

## Types & Variables

```go
// Defn
type MyInt int

// Simple types
x int
p *int
a [5]int

// Variables
var indexed = a[5]
var deref = *p

// Declarations
var a, b, c int
func a() {
	var d, e, f string
}

// Initializers
var i, j int = 1, 2  // Can omit type, it is inferred

// Short hand declarations
func a() {
	a := 2
}

// Block declarations
var (
	a int    = 2
	b string = "hi" 
)

// Type conversion
i := 42
f := float64(i)

// Constants
const Word = "hello"
```

- Types
	- bool
	- string
	- int, int8-64, uint8-64, uintptr
	- byte (alias for uint8)
	- rune (alias for int32 - unicode codepoint)
	- float32-64
	- complex64-128
- Variables without initialization have zero values
	- `0` for numerics
	- `false` for boolean
	- `""` for strings
	- `nil` for pointers, slices, maps
- Type conversions are explicit for assignments
- Constants cannot be declared using `:=`
- Inside a function, the `:=` short assignment statement can be used in place of a `var` declaration with implicit type. This cannot be used outside functions.

## Functions

```go
// Defn
func add(x int, y int) int {
	return x + y
}
func add(x, y int) {}  // Sugar to omit first types when types are same

// Multiple results
func swap() (string, string) {
	return "", ""
}
a, b = swap()

// Named/Naked returns
func split() (x, y int) {  // Named return used to document meaning
	x = 2
	y = 3
	return  // Implied that x and y are returned
}

// Main
func main() {
	add(2, 3)
}

// Function values
func compute(fn func(int, int) int) int {
	return fn(2, 3)
}

// Closures
func adder() func(int) int {
	return func(x int) int {}
}
```

- Functions are values and can be passed around

## Conditionals and Iteration

```go
// for
for i := 0; i < 10; i++ {}
for ; i < 10; {}  // Optional init, post
for i < 10 {}  // Similar to a while loop
for {}  // Infinite loop
for index, elem := range slice {}
for key, value := range maps {}

// if
if x < 0 {
} else {
}
if x := 10; x < 20 {}  // Can start with a statement, scoped to if/else

// switch
switch a := "hi", a {
	case "ho":
		fmt.Println("h")
	default:
		fmt.Println("d")
}
switch {  // No condition, switch true (if else chain)
	case a < 12:
	case a < 20:
	default:
}

// defer
func main() {
	defer fmt.Println("world")
	fmt.Println("hello")
}
```

- Go has only one loop construct - `for`
- The basic `for` loop has three components separated by semicolons
	- the init statement: executed before the first iteration
	- the condition expression: evaluated before every iteration
	- the post statement: executed at the end of every iteration
- Go switch does not require `break`, its provided automatically
- A defer statement defers the execution of a function until the surrounding function returns. 
	- Deferred function calls are pushed onto a stack. When a function returns, its deferred calls are executed in LIFO.
	- Usually used in cleanup functions that exist right next to allocation/initialization functions.
	- [More on defer](https://go.dev/blog/defer-panic-and-recover)

## Complex types

```go
// Pointers
var p *int  // Declaration
i := 42
p = &i  // Ref/Creation
j := *p  // Deref/Indirection

// Struct
type Point struct {
	X int
	Y int
}
p := Point{1, 2}  // Initialization
p := Point{X: 1}  // Named init, Y is zero valued
p.X = 3  // Access
ptr := &p
ptr.X = 3  // Implicit deref and access

// Array
var a [10]int
arr := [6]int{1, 2, 3, 4, 5, 6}
arr[0]

// Slice
primes := [6]int{2, 3, 5, 7, 11, 13}
var s []int = primes[1:4]  // [) range
var s []int = primes[:]

// Maps
var m map[string]Point
m = make(map[string]Point)  // Initialisation
m["A"] = Point{X: 1, Y: 2}

var m = map[string]Point{"A": Point{1, 2}, "B": Point{2, 5}}
var m = map[string]Point{"A": {1, 2}, "B": {2, 5}}

elem, ok := m["C"]  // ok tests if key is present
```

- Go has no pointer arithmetic
- Go allows implicit dereference and access of fields of struct pointers
- Arrays cannot be resized and the length is part of its type
- Slices
	- A slice is a dynamically sized, flexible view into elements of an array, it indicates no amount in its type - `[]T`
	- A slice does not store any data, its a view/ref
	- Changing the elements of a slice modifies the array
	- Other slices also reflect those changes
- Maps
	- A `nil` map has no keys, nor can keys be added. The `make` function initializes it

## Methods and interfaces

```go
// Method
func (p Point) Sum() int {
	return p.X + p.Y
}
p := Point{1, 2}
p.Sum()
ptr := &Point{1, 2}
ptr.Sum()  // Auto deref

// Interface
type Abser interface {
	Abs() int
}
func (p *Point) Abs() int {
	return p.X + p.Y
}
var a Abser
p := Point{1, 2}
a = &p
a = p  // Does not work as Point does not implement Abser, only *Point does
```

- Methods
	- Go does not have classes, instead you can define methods (a function with a receiver arg) on types
	- Can be declared on non-struct types
	- The receiver arg can be a pointer too
	- You cannot declare a method with a receiver whose type is defined in another package
	- Go has automatic ref/deref creation when calling methods with a pointer receiver on values and calling methods on pointer values respectively
	- All methods on a given type should have either value or pointer receivers, but not a mixture of both
- Interface
	- Set of method signatures
	- A value of interface type can hold any value that implements those methods
	- Interface need not be explicitly declared on methods - no `implements` keyword
	- Under the hood, interface values can be thought of a tuple - `(value, type)`
	- If the concrete value inside the interface itself is nil, the method will be called with a `nil` receiver. The `nil` value can be handled inside the method (receiver should be a pointer)