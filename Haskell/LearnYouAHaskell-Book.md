# Haskell

## Features

- A purely functional PL (referential transparency, deterministic behaviour)
- Lazy (Calculates & executes when forced)
- Statically typed
- Type inference

## GHCI

- `:t` - typeof variable
- `:l` - load file

## Simple operations

```haskell
-- Arithmetic
2 + 15
50 * 100
5 * (-3) -- Parentheses needed

-- Booleans
not (True && False || False)
5 == 5
2 /= 5
```

- Operators are just infix functions.

## Functions

```haskell
-- Defn
doubleMe x = x + x -- No brackets, space separated

-- Function application
doubleMe 5

-- Pre-infix functions
div 92 10
92 `div` 10
```

- Order of definition does not matter.
- We use `'` at the end of functions to denote a strict version of the function.
- Functions can't begin with uppercase letters

## Conditionals

```haskell
double x = if x > 100
			then x
			else x * 2
```

- `if` conditional is an expression.

## Lists

```haskell
-- Defn
numbers = [1, 2, 3, 4, 5]
a = [1]
b = [2]

-- Concatenation
a ++ b

-- Cons
2 : a
'a' : " hello"  -- a hello
[1, 2, 3] == 1 : 2 : 3 : []

-- Indexing
"Hello" !! 2  -- l

-- Basic functions
head [1, 2, 3]  -- 1
tail [1, 2, 3]  -- [2, 3]
last [1, 2, 3]  -- 3
init [1, 2, 3]  -- [1, 2]
length [1, 2, 3]  -- 3
null []  -- True
reverse [1, 2, 3]  -- [3, 2, 1]
take 5 [1, 2]  -- [1, 2]
drop 5 [1, 2]  -- []
cycle [1, 2, 3]  -- Infinite list [1, 2, 3, 1, 2 ...]
repeat 5  -- [5, 5, 5, ...]
sum, product, maximum, minimum, elem

-- Ranges (Enumerated sequences)
a = [1..20]  -- Inclusive
a = [2,4..8] -- Step value of 2
b = [20..1]

-- List comprehension [expr|list,predicate]
double = [x*2 | x <- [1..10], x*2 >= 12, x > 1]
bb xs = [ if x < 10 then "BOOM" else "BANG" | x <- xs, odd x ]
a = [ x*y | x <- [2,5,10], y <- [8,10,11]]
length' xs = sum [1 | _ <- xs]
```

- Homogenous data structure
- Strings are a list of chars

## Tuples

```haskell
-- Defn
a = [(1, 2), (2, 3)]
b = [(1, "a"), (2, "b")]
rightTriangles = [ (a,b,c) | c <- [1..10], b <- [1..c], a <- [1..b], a^2 + b^2 == c^2]

-- Functions (pair only)
fst (2, 3)  -- 2
snd (2, 3)  -- 3
zip [1, 2] [3, 4]  -- [(1, 3), (2, 4)]
```

- Type depends on components and number of values
- Heterogeneous
- No singleton tuples
- Tuples of varying sizes cannot be compared

## Types

```haskell
-- Basic types (:: is read as - has type of)
'a' :: Char
True :: Bool
"a" :: [Char]
(True, 'a') :: (Bool, Char)

-- Functions
-- removeNonUppercase :: [Char] -> [Char]  
removeNonUppercase :: String -> String  
removeNonUppercase st = [ c | c <- st, c `elem` ['A'..'Z']]

addThree :: Int -> Int -> Int -> Int  
addThree x y z = x + y + z

-- Type variables
head :: [a] -> a
```

- Types
	- `Int`
	- `Integer` - unbounded integer, can be very large
	- `Float`
	- `Double`
	- `Bool`
	- `Char`
- Type variables
	- Generic types usually represented by lowercase alphabets
	- Functions that have type variables are called polymorphic functions

## Typeclasses 1

```haskell
-- Defn
(==) :: (Eq a) => a -> a -> Bool  -- Eq or equality typeclass

-- Examples
(==) :: (Eq a) => a -> a -> Bool  -- Equality, members implement == & /=
(>) :: (Ord a) => a -> a -> Bool  -- Ordering, members implement >,<,>=,<=
show :: (Show a) => a -> String  -- Shown as strings
read :: (Read a) => String -> a  -- Opposite of Show, reads a string and returns a type which is a member of Read
Enum  -- Members are sequentially ordered types
Bounded  -- Have upper and lower bound
Num  -- Numeric typeclass, members act like numbers (take in ints and floats)
fromIntegral :: (Num b, Integral a) => a -> b  -- Num but only integral numbers
Floating  -- double & float
```

- Sort of interface that defines behaviour. If a type is a part of a typeclass, that means that it supports and implements the behavior the typeclass describes.
- `=>` is a **class constraint**. The type of values must be a member of the typeclass

## Pattern matching

```haskell

```