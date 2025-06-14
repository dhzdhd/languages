# F# reference

https://learn.microsoft.com/en-us/dotnet/fsharp/language-reference/

## Literals & Values

```fsharp
/// Numeric types
let a: sbyte = 5y // signed 8-bit integer
let b: byte = 5uy // unsigned 8-bit natural number
let c: int16 = 5s // signed 16-bit integer
let d: uint16 = 5us // unsigned 16-bit natural number
let e: int = 500_200 // signed 32-bit integer
let f: int32 = 5l // signed 32-bit integer
let g: uint = 5u // unsigned 32-bit natural number
let h: uint32 = 5ul // unsigned 32-bit natural number
let i: nativeint = 5n // native pointer to a signed natural number
let j: unativeint = 5un // native pointer as an unsigned natural number
let k: int64 = 5L // signed 64-bit integer
let l: uint64 = 5UL // unsigned 64-bit natural number
let m: single = 5.0f // 32-bit floating point number
let n: float32 = 5.0F // 32-bit floating point number
let o: float = 5.0 // 64-bit floating point number
let p: double = 5.0 // 64-bit floating point number
let q: bigint = 5I // integer not limited to 64-bit representation
let r: decimal = 5.0M // fractional number represented as a fixed point or rational number


/// Integers in other bases
let h = 0xF
let b = 0b0
let o = 0o7


/// Special floating point infinity values
let a = infinity
let b = infinityf


/// Character and string types
let s: char = 'a' // Unicode character
let t: string = "hello" // Unicode string
let u: byte = 'a'B // ASCII character
let v: byte[] = "hello"B // ASCII string
let w: string = @"c:\path\file" // verbatim Unicode string
let x: byte[] = @"c:\path\file"B // verbatim ASCII string


/// Named literals
let y = "a" + "b"  // Evaluated at run-time

[<Literal>]
let Y = "a" + "b"  // Evaluated at compile-time

[<Literal>]
let Y () = "a" + "b"  // Error: values not known at compile-time

[<DllImport(Y, CallingConvention = CallingConvention.Cdecl)>]
extern void HelloWorld()  // An example where y has to be a Literal

match code with 
| Y -> ""  // Using a literal here removes need for `y when y = "ab"`
| _ -> ""


/// String operations
let c = str[1]
let sub = str[0..2]
let barr: byte[] = "abc"B  // Byte array
let c = "a" + "b"  // String concatenation


/// String interpolation
let n = 2
let a = $"{n}"  // 2
let b = $"{{n}}"  // {n} - braces are escaped with more braces
let c = $$"{{n}}"  // 2 - number of $ => number of {} to use
let d = $"%d{n}"  // Typesafe interpolation
let pi = $"%0.2f{System.Math.PI}"  // 3.14 - format specifier


/// Values
let a = 5  // Value binding
let mutable b = 5  // Mutable values
b <- 6  // Assign new value


/// Bindings
let abc = 
	5
let i, j, k = (1, 2, 3)  // Tuple destructuring
do run "arg1" "arg2"
```

- F# supports the above datatypes for literals
- Literal attribute/constants
	- Values that are intended to be constants and are to be evaluated at compile time should be marked with the `Literal` attribute
	- Functions cannot be marked with this even though they seem to produce constant outputs as functions are evaluated at compile-time.
	- These are usually named in PascalCase as it helps in pattern matching (lowercase is treated as a variable to be bound). This also implies that the `when` can be removed altogether
- String type
	- `string` represents immutable text as a sequence of Unicode characters. Alias for `System.String`
	- Verbatim/Triple quoted strings can be used for raw strings - escape sequence chars are ignored
	- Adding a `B` at the end of a string converts it into a byte array
- String format specifiers in interpolation
	- Specify format of a decimal with prefixed `%0.nf{}`
	- Pretty print lists with `%A{}`
- Values
	- Quantities that have a specific type
	- Can be integral or floating point numbers, characters or text, lists, sequences, arrays, tuples, discriminated unions, records, class types, or function values.
	- Values are immutable by default
- Bindings
	- `let`
		- `let` is used to bind a name to a value or function
		- Cannot appear in structures or records but can in classes
		- The scope of an entity declared with a let binding is limited to the portion of the containing scope (such as a function, module, file or class) after the binding appears
	- `do`
		- Used to execute code without defining a function or value
		- Expression in a `do` binding must return `unit`
		- This binding is optional to use
- `fixed` keyword
	- TODO https://learn.microsoft.com/en-us/dotnet/fsharp/language-reference/fixed

## Functions

```fsharp
/// Defn
let fn arg = arg
let fn (arg: int) : int = arg
let inline fn arg = arg  // Inline
let rec fn arg = fn arg  // Recursive

fn 2  // 2


/// Partial application
let fn a b = a + b
let fn2 = fn 5
let res = fn2 2  // 7


/// Functions as values
let fn (fnArg: int -> int -> int) : int = fnArg 2 3


/// Lambda expressions
let lambda = (fn x -> x)


/// Pipelines
let result = 
	100
	|> fn1
	|> fn2


/// Composition
let fn1 x = x + 1
let fn2 x = x + 2
let fn3 = fn1 >> fn2
fn3 2  // 5
```

- F# treats functions as values, contains lambdas, allows function composition currying and partial application
- Parameters are separated by spaces, and the types are automatically inferred based on the body, with attempts to make the type as generic as possible
- The return type is inferred from the final expression in the function body
- Apart from the module scope, name shadowing is allowed
- Partial application
	- Supplying fewer args creates a new function that expects remaining args
	- This method of handling args is called **currying**
- Pipelines
	- The `|>` pipe operator enables function calls to be chained as successive operations
	- The expression to the left is passed as the argument to the function on the right
	- Has the backwards pipe operator too `<|`
- Composition
	- The `>>` composition operator takes two functions and returns a function
	- Has the backwards composition too `<<`
- Recursive functions
	- TODO https://learn.microsoft.com/en-us/dotnet/fsharp/language-reference/functions/recursive-functions-the-rec-keyword
- Inline functions
	- 