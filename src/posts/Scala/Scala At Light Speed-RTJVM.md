# Scala

A mix of functional and object oriented programming language based on the JVM

## Project setup

```scala
// Init
sbt new scala/scala3.g8  // Pulls scala3 template and creates a project

// Boilerplate
object Main extends App {

}

// Run
sbt
> ~run
```

- A project has to be setup to use scala or the REPL can be used.
- The project directory is used by `sbt` to install and manage plugins.

## Basics

```scala
// Defn
val x: Int = 42  // Creates a constant integer x
val str: String = "Hello"
val chr: Char = 'C'

// String composition & interpolation
val compose = "I" + "Hi"
val inter = s"$x $str"

// Code blocks
val block = {
	val localVal = 7

	localVal + 3
}

// Unit type (no meaningful value/void)
val unit: Unit = println("Hi")
val unitVal: Unit = ()
```

- Values (`val`) are immutable and are composed to create new values.
- Mutables (`var`) exist but should not be preferred.
- Types need not be necessarily specified due to type inference.
- Regular types
	- Int
	- Boolean
	- String
	- Char
	- Float/Double
- Code blocks are structured segments that contain members local to the block and have to return a value at the end which is the value of the block.
- Unit types are for side effects and have no meaningful value.

## Conditionals and Loops

```scala
// Defn
val ifExpr = if (x > 2) 2 else 3  // Like a ternary (similar to python)
val chainedIf = 
	if (x > 2) 3
	else if (x < 2) 4
	else 5
```

- If statements are expressions along with most structures in Scala.
- The fundamental practice in Scala is to use recursion like in pure FP languages instead of loops.
- Loops exist but should not be preferred

## Functions

```scala
// Defn
def func(x: Int, y: String): String = x + " " + y
def largerFunc(x: Int): Int = {
	x + 2
}
def recFunc(x: Int): Int =
	if (x <= 1) 1
	else x * recFunc(x - 1)
```

## Object oriented programming

```scala
// Class Defn
class A {
	val x: Int = 0
	def foo() = println(x)
}

// Inheritance
class B(y: Int) extends A
class C(val z: Int) extends A

// Instance defn
val inst1 = new A
val inst2 = new B(2)
val inst3 = new C(2)
inst3.z

// Subtype polymorphism
val inst: A = new B(2)
inst.foo()

// Abstract class
abstract class Abs {
	val x = true
	def foo(): Unit
}
class Child extends Abs{
	override def foo(): Unit = ()
}

// Interface/Trait
trait T {
	def foo(x: Int): Unit  // Can provide impls
}
class Child with T {
	override def foo(x: Int): Unit = ()
}

// Infix calling (only 1 argument methods)
val inst = new Child
inst.foo(2)
inst foo 2

// Method operators
val x = 1 + 2
val x = 1.+(2)

// Anonymous class
abstract class D {
	def foo(): Unit
}
val inst = new D {
	override def foo(): Unit = println("Hi")
}

// Singleton object
object Singleton {
	val x = 2
	def foo() = ()
}
Singleton.foo()

// apply() method
class A {
	def apply(x: Int): Int = x + 1
}
A(2) == A.apply(2)
```

- Class definition argument also defines the constructor - i.e. it need not be defined separately. These are however, not fields
- Adding a `val` to the constructor argument makes it a class field/member
- Like other languages, Scala has subtype polymorphism and the most derived method is called at runtime.
- All fields and methods are public by default which can be restricted with `
	- `private` - only class has access
	- `protected` - only class and descendants have access
- Scala provides single class inheritance but multi class interfaces.
- Like Java, you can have multiple method definitions with different arguments but with the same name
- Operators in Scala are methods
- Anonymous classes create a unique class during runtime that extends the class in the definition
- Singleton objects create a type and the only instance of that type
- The `apply` method allows you to call that method using the class directly, i.e. invoke it like a function