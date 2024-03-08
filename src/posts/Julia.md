# Julia

## Variables

```julia
# Defn
x = 5

# Can redefine constants which is not currently in use
pi = 5

# Operators in brackets
(+) = f # Reassigns the operator

_ = a # Discards a
a = _ # Error

# Assignment chaining
# Assignment is basically binding value to variable
a = (b = 5) + 3 # a=8, b=5

a = []
b = a # Binds b to the same array (no copy made)

c = nothing # Equivalent to None in python
```

- Stylistic conventions
	- Variables are snake_case
	- Types, modules are PascalCase
	- Functions, macros are lowercase w/o underscore
	- Mutating functions end in `!`

## Integers

```julia
# Types
Int8, UInt8, Int128, Bool, Float16, Float64

# Size is arch dependent
typeof(1) # Int64 in 64 bit

# Diff base
a = 0x123 # typeof returns UInt
b = 0b101011
c = 0o1723
d = -0x23

# Max/min repr values
typemin(Int32)

# Floats
a = 1e10
a = 1.32
b = 0x1p0

a = Inf
b = NaN

a = big"133444444444444444444444444"
a = BigInt(133444444444444444444444444)

# Easy poly exprs
2x^2 + 3x + 1
# 2^3x = 2^(3x)
# 2x^3 = 2(x^3)

a = (x-1)x
a = x(x-1) # Error due to fn application
a = 2(x+y) # Works because literal

zero(Float32) # 0.0f0
one(Int32) # 1
```

- Overflow results in wraparound
- `BigInt, BigFloat` available but type promotion has to be explicitly stated

## Math Operations & Functions

```julia
x / y # divide
x (division symbol) y # int divide
x \ y # inverse divide
x ^ y # power

NaN * false # 0.0
false * Inf # 0.0

x (|| or &&) y # Short circuited

x += 1

# Every binary op has a corresponding vectorized dot op
# Unary like ! and (root) too
[1, 2, 3] ^ 3 # Error
[1, 2, 3] .^ 3 # Elementwise mult

# Nested dot calls are fused & adjacent are converted to nested forms
x .+ 3 .* x.^2 = (+).(x, (*).(3, (^).(x, 2)))

# @. macro applies dot op to all elements inside
2 .* A.^2 .+ sin.(A) = @. 2A^2 + sin(A)

# Updating op too support dot
a .+= b or @. a += b = a .= a .+ b

1 .+ x # Error

# NaN is not equal to anything
NaN == NaN # False
[1, NaN] == [1, NaN] # False
isequal([1, NaN], [1, NaN]) # True & should be used
isinf(), isfinite(), isnan() # Other useful funcs

# Comparisons can be chained like python & dotted
# Order of comparison is undefined
0 .< A .< 1
1 < 2 <= 3 # true
1 > 2 <= 3 # false

# Op precedence (:x are symbols)
Base.operator_precedence(:+) # 11
Base.operator_associativity(:-) # :left

# Numeric conversions
T(x) or convert(T, x) # Int8(323) - Error
x % T # Converts int types, overflows if too big w/o error
round(Int, x) = Int(round(x))

# sinpi, cospi provide better repr of sin(pi*x)
a = sinpi(x)
a = sind(x) # In degrees (default is radian)
```

## Complex & Rational numbers

```julia
# Complex numbers
1 + 2im
(2 + 3im) - 1 # 1 + 3im
3/4im = 3 / (4im)
real(), imag(), conj(), angle(), abs(), abs2() # abs squared
complex(a, b) # Use over a + b*im

# Rational numbers (not floats!!!)
# Always reduced to lowest form
2 // 3 # Construction
numerator(), denominator()
2//3 == 6//9 # true
0 // 0 # Error
```

## Strings

```julia
# Char
a = 'x'
b = Int(a) # 120, Int64
c = '\u0ff' or '\U10ffff'
d = '\n' or '\t'

# Strings
a = "hi" or """hello"""
b = "hellllooooo \
	hi"
c = """jefej
	ejofefj"""
	
c = a[1] or a[begin] or a[end]
d = b[1:2] # Range indexing & makes a copy
e = SubString(b, 1, 2) or @views b[1:2] # Creates a view, not a copy

for c in s
	println(c)
end

nextind(), prevind(), eachindex() # To find valid indices
codeunit(s, i) # Access raw codeunit

# Concatenation
c = string(a, ", ", b)
c = a * ", " * b # * used rather than + to show noncommutativity

# Interpolation
a = 234
b = "$(a + 1) $a"

# Functions
findfirst(c, s), findlast(c, s), findnext(c, s, i)
occursin(s1, s2)
repeat(s, times), replace(s1, func)
join(vec, s, last_s)
length(s)

# Regex
reg = r"^\s" or Regex(str)
occursin(reg, s), match(reg, s)

# Byte array literals
bal = b"hello" # UInt8 array

# Version literals
ver = v"0.2"

# Raw literals
r = raw"huehfu" # Extra quotation should be escaped
```

- String supports full UTF-8
- All string types are subtypes of `AbstractString` & all char types of `AbstractChar` (It is better to use these in function definitions)
- Strings are immutable
- Strings are byte indexed, not char indexed
- Characters are 32 bit primitive
- Indexing starts from 1, not 0
- Not every index into a String is necessarily a valid char
- Number of chars in String is not always same as last index (due to variable length encoding)

## Functions

```julia
# Definitions
function f(x, y)
	x + y
end

f(x, y) = x + y

# Calling
f(2, 3)
g = f
g(2, 3)

# Arg behaviour
function f!(x::Vec, y::Integer)
	x[1] = 5 # Mutates
	y = 7 # No mutation of og object

# Return types
# Return type enforced and return value is converted
function g(x) :: Int8 
	x
end

# Operator fn
# Except for &&, || all other can be used as fn
+(1, 2, 3) # 6

# Anon fn
x -> x^2 + x + 1
() -> 3
(x, y) -> x + y

# Tuples
a = (1, 2, 3) # Immutable, fixed length containers
b = (1,)
println(a[0])

# Named tuples
x = (a=2, b=3)
x[0] or x.a

# Destructuring
(a, b, c) = [1, 2, 3] # RHS has to be an iterable
_, _, c = [1, 2, 3]
arr[0], b = [1, 2] # arr[0] is mutated

# Slurping
# Assignment of a collection of remaining elements
a, b..., c = "hello" # a=h, b=ell, c=o

# Argument destructuring
f((x, y)) = x + y
f((2, 3))

# Property destructuring
foo((; x, y)) = x + y
foo((x=2, y=2)) # Advantage is that both structs and namedtuples can be passed

# Varargs
# In definition
foo(a, b, x...) = x # x is a tuple
# In caller
x = (2, 3, 4)
foo(1, x...) # a=1, b=2, x=(3, 4), the callee need not be a varargs function

# Optional args
function x(a, b=1, c=1)
	a
end
x(1)
x(1, 2)
x(1, 2, 3)
methods(x) # Shows all possible methods of fn x

# Keyword args
function x(a, b; c=1, d=1, kwargs...) # kwargs collects extra keyword args (a immutable key value iterator)
	a
end
x(1, 2, c=1, d=2)
x(1, 2, c=1, :d=>2)
# In case kwargs has same name as other keyword arg, that arg takes pref

# Concise do blocks
# do creates an anon fn
# do a, b = 2 args & do (a, b) = tuple arg
# do can capture vars from outer scope and automatically close streams, etc
map(x->x, [])
map([]) do x
	x
end

# Composition & piping
(f \circ g)(x) = f(g(x))
1:10 |> sum |> sqrt
["a", "b"] .|> [uppercase, lowercase]
```

- Functions are first class objects that map tuple of arguments to a return value
- Not pure
- No explicit return required
- Values are not copied to arguments, rather are shared. Arguments act like new bindings to the values (like Python)
- Mutating function identifiers end in `!`
- Reasons to have arg types
	- No perf impact
	- Correctness & Clarity
	- Dispatch - can have different versions of a fn for diff arg types
- Do not overly restrict types & omit when not sure
- Return types are not usually used and instead automatically inferred 
- Operators with special names ![](https://i.imgur.com/t39Uq8h.png)

## Control Flow

```julia
# Compound exprs
z = begin
	x = 1
	y = 2
	x + y
end
z = (x=1; y=2; x+y)

# Conditional eval
if x < y
	...
elseif x > y
	...
else 
	...
end

a ? b : c

# Short circuits
n >= 0 || error("n must be positive")

# Loops
i = 0
while i <= 3
	global i += 1
end

for i = 1:3 # 1:3 is a range object
	...
end
for i in []
	...
end
for i = 1:2, j = 3:i # Nested loop, break exits both loops
	...
end
for (i, j) in zip([], []) ...

# Exceptions
struct Custom <: Exception 
	var::Symbol
end # Custom exception
throw(DomainError(1, ""))
error("") # Stops execution
try
	...
catch e
	if isa(e, DomainError) ...
else # Used instead of extending try so as to not catch more errors
	...
finally
	...
end
```

- `if` blocks are leaky, i.e they do not introduce a local scope. New variables defined can be used later
- `if` blocks return values 
- `1/0` do not convey boolean meanings
- `&&, ||` are short circuited, second exprs are not evaluated if first satisfies the operator
- `&, |` are not short circuited

## Scope 

```julia
# Local scope

# Constants (best used with globals, local consts are not supported)
const pi = 3.14
const a, b = 1, 2
x::Float64 = 2.7 # Automatically a constant if globally declared
```

- Two types - global and local
- `if` does not introduce a new scope
- Inner scopes can see variables in outer scopes
- Modules 
	- Introduce new global scopes
	- Variables present can't be mutated from other modules directly
- Constants
	- Not supported by local vars
	- Structs are const by default

## Types

```julia
# Types
(1+2)::Int # Asserts type
a::Int = 1 + 2 # Specifies/Declares type

# Abstract types
abstract type Number end
abstract type Signed <: Integer end # <: specifies supertype (defaults to Any)

Integer <: Number # true

# Primitives
primitive type Float16 <: AbstractFloat 16 end # Specify bits

# Composite types
struct Foo
	bar
	baz::Int
end
mutable struct A
	a
	const b::Int
end
foo = Foo("", 1) # Constructor
foo.bar # ""
fieldnames(Foo) # (:bar, :baz)

# Type unions
IntOrStr = Union{Int, AbstractString}
Option = Union{Nothing, Int} # Like Option<T>

# Parametric types (types with parameters)
# Composite
struct Point{T}
	x::T
	y::T
end
Point{AbstractString} <: Point # true
Point{<:AbstractString} # Subtypes also accepted now
Point{Float64}(1.0, 2.0)
# Abstract
abstract type Pointy{T, X} end
abstract type Pointy{T<:Real} end # Guard

# Tuple types
Tuple{Int, String}
Tuple{Int, Vararg{String}} # Variable arg type

# Named tuple types
@NamedTuple{a::Int, b::String}
@NamedTuple begin 
	a::Int 
	b::String
end 

# UnionAll types
```

- Julia is dynamically typed, is nominative and parametric
- Has method dispatch with on types of args
- All concrete types are final and can only have abstract types are supertypes
- All values in Julia are true objects
- No compile time type exists
- Variables don't have types, only values do
- Abstract types
	- Can't be instantiated
	- `Any` is at the top of the type graph and `Union{}` at the bottom
	- Gives default impls for concrete types (make it generic)
- Primitive types
	- Do not make your own
- `struct` is immutable but contained objects that are mutable remain mutable. Mutables are alloc on heap
- All 3 types are repr internally as `DataType`
- Type params are invariant
	- `Float64 <: Real but P{Float64} not subtype of P{Real}`
- Tuple type params are covariant

## Methods

```julia
# Defn
f(x::Float64) = 2x
f(x::Number) = 2x
f(2.0)
f(2)

# Parametric methods
same_type(x::T, y::T) where {T} = true
same_type(x,y) = false
same_type_numeric(x::T, y::T) where {T<:Number} = true # Guard

# Redefining methods

# Design patterns

```

- Definition of one possible behaviour of a function is called a method
- When a function is applied to a particular tuple of arguments, the most specific method applicable to those arguments is applied.
- The choice of which method to execute when a function is applied is called dispatch.
- Multiple dispatch used where all args are considered (unlike other langs where only first considered)
- The first method definition for a function creates the function object, and subsequent method definitions add new methods to the existing function object. Creating multiple methods is called specialization
- Other than explicit method decl, Julia implicitly creates methods at compile time based on arg types

## Modules

```julia
module FastThings
end

# Qualification
Base.sin()
Base.:+ # Needs a colon for operators

# Exports
module A
export b, C
const C = 5
b(x) = x
end

# Using modules
using A # Adds elements of export list to global namespace
using .A # Load module from locally defined module
import A # Allows only qualified access (export list does not matter)
import A as B
import A:a as b
using .A:a, b, A # Specific name imports (specify modulename itself to import it too)

# Adding methods
using .A or import .A:a # using .A:a won't work
A.a() = ...

# Baremodules (w/o containing Base, eval and include)
baremodule A

# Submodules
module A
module B
import ..C:a # Each . = parent
end
end
```

- They are separate namespaces and introduce a global scope
- Can export and import names
- Can be precompiled
- Can have multiple modules per file and vice versa
- PascalCase and plural
- Standard modules
	- Core - builtins
	- Base - base functionality
	- Main - top level and current module

## Documentation

```julia
"Info" # Interpreted as markdown
foo(x) = x

# Enables to use raw, and other types of string including interpolation
@doc raw"""
"""
f(x) = x

@doc(@doc foo!)foo # Use foo!'s documentation
```

## Metaprogramming

```julia

```

- Lisp style macros operating at the level of AST

## Arrays

```julia
zeroes(Int8, (2, 3))
ones(...), trues(), falses()
reshape(), copy(), deepcopy()
range(), fill!()
Matrix{T}()

# Array literals
[1, 2, 3] # Tries to promote if diff types, else heterogeneous
Int8[1, 2, 3]

# Concatenation
[1:2, 4:5] # 2D array
[1:2; 4:5] # Vertically concats (1, 2, 4, 5)'
[1:2;; 4:5] # Horizontally concat (1, 2, 4, 5)

# Comprehensions
[x + y for x=1:2, y=2:3 if x + y == 2]
[(i,j) for i=1:3 for j=1:i] # Nested loop

# Generators
(i*2 for i=1:10)

# Indexing
a[1, 2]
a[(1, 2)]
x[2:3, 2:end-1] 

# Indexed assignment
x[2, 3] = 1
x[CartesianIndex(1, 2, 3)] # Groups indices into one obj
x[[false, true], :] # Boolean indexing
x[map(ispow2, x)]
x[5] # If x is multidim, a single element is returned in column major form
```

- Need not do vectorized impl for perf
- ![](https://i.imgur.com/Y5v4bDQ.png)
- Using `eachindex(a)` is better than `1:length(a)`