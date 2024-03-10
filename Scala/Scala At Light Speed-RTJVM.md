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

- A project can be setup with SBT or files can be individually compiled with `scala <file>` or the REPL can be used.
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

// Collections
// List
val list = List(1,2,3)
val prepend = 0 :: list  // 0, 1, 2, 3
val prepend = 0 +: list
val append = 0 :+ list  // 1, 2, 3, 0

// Sequence
val seq = Seq(1,2,3)  
val indexed = seq(1)  // Calling apply method indexes the seq

// Vector
val vec = Vector(1,2,3)

// Set
val set = Set(1,2,3,1,2)  // 1, 2, 3

// Range
val range = 1 to 1000

// Tuple
val tup = ("Hi", 2)

// Map
val map: Map[String, Int] = Map(
	("a", 1),
	"b" -> 2,  // Equivalent to ("b", 2)
)
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
- Collections
	- List 
		- Has a head and tail(rest of list)
		- Implemented as a linked list internally
		- Prepend items with `::` or `+:`, similar to `cons` in other languages
		- Append with `:+`
	- Sequence
	- Vector
		- Fast `seq` implementation
	- Set
		- `+` and `-` is overridden to add/delete elements
	- Range
		- Creates a lazy collection where all numbers are not initialized on definition
	- Tuple
		- Like `pair/tuple` in other languages and contain heterogenous data
	- Map

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

// Companions
class X
object X {
	val foo = false
}
val bar = X.foo

// Case class
case class Y(foo: String, bar: Int)
val x = new Y("", 1)
val x = Y("", 1)  // Equivalent

// Generics
abstract class L[T] {
	def head: T
	def tail: L[T]
}
val lst = List[Int] = List(1,2,3)  // List.apply(1,2,3)
```

- Extending `App` implies we are inheriting the main method in `App`
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
	- They cannot have constructors
	- `apply` method acts like a factory method
- The `apply` method allows you to call that method using the class directly, i.e. invoke it like a function
- Companions are formed when a class and singleton object (can be applied to traits too) share the same identifier.
	- The private fields are shared by both.
	- The singleton object and the objects formed by instantiating the class are different
	- We generally use the singleton object only to access fields that do not depend on the class (works like `static` in other languages)
- Case classes are lightweight structures that generate boilerplate
	- Add sensible `equals` and `hash code`
	- Add serialization
	- Add companion with the `apply` method (which defaults to taking constructor arguments as its arguments)
	- They do not need `new` to be instantiated
	- Work with pattern matching
- Objects are also immutable and any method returns a new object

## Exceptions

```scala
// Exceptions
try {
	val x: String = null
	x.len
} catch {
	case e: Exception => "Error!"
} finally {
	// Execute stuff regardless of exception
}
```

## Functional programming

```scala
// FunctionX
val incr = new Function1[Int, Int] {  // An anonymous trait, first generic is the passed arg, 2nd is the return type
	override def apply(arg: Int): Int = arg + 1
}
incr(23) 

// Anonymous functions
val doubler: Function1[Int, Int] = (x: Int) => 2 * x
val doubler: Int => Int = (x: Int) => 2 * x

val flatMap = List(1).flatMap(x => List(x))
val flatMap = List(1).flatMap { x => 
	List(x)
}
val flatMap = List(1).flatMap(List(_))  // _ refers to x

// For comprehension
val pairs = for {
	number <- List(1,2,3)
	letter <- List('a','b','c')
	yield s"$number-$letter"
}

// Pattern matching
val int = 5
val order = int match {
	case 1 => "one"
	case 2 => "two"
	case _ => "none"
}

case class P(name: String, age: Int)
val a = P("A", 50)
val r = a match {
	case P(name, age) => s"$name $age"
	case _ => "none"
}

val tup = ("a", "b")
val res = tup match {
	case (first, second) => s"$first $second"
	case _ => "none"
}

val l = List(1,2,3)
val res = l match {
	head :: tail => tail
	_ => List()
}
```

- The JVM is not fundamentally built for FP
	- All functions are instances of this trait(FunctionX) present internally
	- X ranges from 1 to 22, 22 being the max number of arguments possible
- Anonymous functions are sugar for creating an apply method inside the Function1 trait
- Function types (`Function1[Type, Type, ...]`) can instead be written as `(Type, ...) => Type`
- For expression is a structured block that is reduced to a value. The compiler deconstructs the block into a chain of list operations - map,flatMap, etc
- Pattern matching block is also an expression and hence can be assigned to a value

## Advanced stuff

```scala
// Lazy eval
lazy val lval = 2  // 2 is not associated with lval until its used 
lazy val sideEff = {  // Not printed until used
	println("Hi")
	2
}
val eager = sideEff + 1

// Special types
// Option
val opt: Option[String] = Option("hi")  // Some("hi")

// Try
def expMethod(): String = throw new RuntimeException
val try: Try[] = Try(expMethod())

// Evaluate on threads (async)
val fut = Future {  // Expr evaluated on separate thread
	println("Loading ...")
	Thread.sleep(1000)
	println("Done")
	50
}

// Implicits
// Implicit args
def method(implicit arg: Int) = arg + 1
implicit val i = 50
println(method)  // No args passed

// Implicit conversions
implicit class RichInt(n: Int) {
	def isEven() = n % 2 == 0
}
23.isEven()  // Does not belong to Int class but is valid here due to implicit
// Sugar for - new RichInt(23).isEven()
```

- Future can be thought of as a collection that contains a value after it's evaluated. It is also composable with `map`, `flatMap`, etc
- Implicit (DEPRECATED)
	- Implicit methods can be called without passing arguments because the compiler figures out what it needs and searches for values of type int that are implicit that can be passed
	- Implicit conversions are used to add methods to types we do not have control over. The compiler finds an implicit wrapper over the type defined by us and applies it to where it is called

## Contextual Abstractions

```scala
// Context parameters/args
val l = List(2,1,3,4,6,5)
l.sorted  // A default ordering of Int is fetched by the compiler and injected into sorted
given desc = Ordering.fromLessThan(_ > _)  // This is used instead of default

trait Combinator[A] {
	def combine(x: A, y: A): A
}
def combineAll[A](l: List[A])(using combinator: Combinator[A]): A = l.head

// Context bounds
def combineAll2[A](l: List[A])(using Combinator[A]): A = l.head  // If combinator is not needed in the func
def combineAll3[A: Combinator](l: List[A]): A = l.head

// Extension methods
case class P(name: String) {
	def greet(): String = ""
}
extension (str: String) {
	def greet(): String = new P(str).greet()
}
val g = "Name".greet()
```

- Context arguments
	- `given`
		- A value defined as given will be used by the compiler with a higher priority over the default wherever applicable. As this is based on the context of where its called, its a contextual arg
		- It is analogous to `implicit` but this is going to be deprecated
		- The compiler looks in the following places 
			- Local scope
			- Imported scope
			- Companions
		- You cannot have 2 `given` of the same type in the same scope
	- `using`
		- The compiler takes care to pass a `given` to the parameter which declares this. It is sort of like a optional argument in that sense
	- `[generic : type]` is a type restriction which states that `generic` must have an instance of `type` in its scope
	- Used in
		- Typeclasses
		- Dependency Injection
		- Context dependent functions
		- Type level programming (compiler generates types/relationships between types during runtime)
- Extension methods
	- Called type enrichment
	- Compiler searches for all possible extension methods on the given type
	- Similar to implicit classes but that will be deprecated 