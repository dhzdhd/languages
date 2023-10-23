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
-- Fn body pattern matching
lucky :: (Integral a) => a -> String  
lucky 7 = "LUCKY NUMBER SEVEN!"  
lucky x = "Sorry, you're out of luck, pal!"

factorial :: (Integral a) => a -> a  
factorial 0 = 1  
factorial n = n * factorial (n - 1)

addVectors :: (Num a) => (a, a) -> (a, a) -> (a, a)  -- Tuple patterns
addVectors (x1, y1) (x2, y2) = (x1 + x2, y1 + y2)

head' :: [a] -> a  -- List patterns using cons
head' [] = error "Can't call head on an empty list, dummy!"  
head' (x:_) = x

length' :: (Num b) => [a] -> b  
length' [] = 0  
length' (_:xs) = 1 + length' xs

capital :: String -> String  
capital "" = "Empty string, whoops!"  
capital all@(x:xs) = all ++ " " ++ xs ++ " " ++ [x]  -- for hello - hello ello h

-- Guards
bmiTell :: (RealFloat a) => a -> String  
bmiTell bmi  
    | bmi <= 18.5 = "You're underweight"  
    | bmi <= 25.0 = "You're normal."  
    | bmi <= 30.0 = "You're fat"  
    | otherwise   = "You're whale"

-- where & let-in bindings
foo :: Int -> Int
foo bar = a + b
	where 
		a = bar * 5
		b = bar + 2

foo :: Int -> Int
foo bar =
	let 
		a = bar * 5
		b = bar + 2
	in a + b
[let square x = x * x; y = 5 in (square 5, square 3, square y)]

calcBmis :: (RealFloat a) => [(a, a)] -> [a]  
-- in not required due to predefined name visibility
calcBmis xs = [bmi | (w, h) <- xs, let bmi = w / h ^ 2, bmi >= 25.0]

-- case expressions
head' :: [a] -> a  
head' xs = case xs of [] -> error "No head for empty lists!"  
                      (x:_) -> x
```

- Pattern matching consists of specifying patterns to which some data should conform and then checking to see if it does and deconstructing the data according to those patterns
- Haskell does not check for exhaustivity of patterns and hence, matches can fail
- `_` is used to ignore a pattern
- Patterns `(@)` are a handy way of breaking something up according to a pattern and binding it to names whilst still keeping a reference to the whole thing.
- Guards are boolean exprs and are indicated by pipes that follow a function's name and params
- Bindings
	- Names defined in `where` are only visible to that function
	- Can use pattern matching in `where` name declarations
	- `let-in` is more constrained than `where` but lets you bind variables anywhere unlike `where`.
	- `let-in` is an expression but `where` is a syntactic construct
- Function pattern matching is syntactic sugar for case exprs

## Recursion

```haskell
maximum' :: (Ord a) => [a] -> a  
maximum' [] = error "maximum of empty list"  
maximum' [x] = x  
-- maximum' (x:xs)   
--    | x > maxTail = x  
--    | otherwise = maxTail  
--    where maxTail = maximum' xs
maximum' (x:xs) = max x (maximum' xs)
```

- Recursion is a way of defining functions in which the function is applied inside its own definition. Due to the lack of loops in Haskell, we use recursion.
- Define a terminating edge/base case and work your way through to find the general case.

## Higher order functions

```haskell
-- Currying
max 4 5
(max 4) 5

compareWithHundred x = compare 100 x
compareWithHundred = compare 100

divideByTen = (/10)  -- Infix curry (does x / 10)

-- Higher order fns
applyTwice :: (a -> a) -> a -> a  
applyTwice f x = f (f x)

zipWith' :: (a -> b -> c) -> [a] -> [b] -> [c]  
zipWith' _ [] _ = []  
zipWith' _ _ [] = []  
zipWith' f (x:xs) (y:ys) = f x y : zipWith' f xs ys

map :: (a -> b) -> [a] -> [b]  
map _ [] = []  
map f (x:xs) = f x : map f xs

filter :: (a -> Bool) -> [a] -> [a]  
filter _ [] = []  
filter p (x:xs)   
    | p x       = x : filter p xs  
    | otherwise = filter p xs
```

- Functions that can take functions as parameters and return functions as return values are called higher order functions.
- Every fn in Haskell takes only one parameter. The functions that accept more are curried.
- `max :: (Ord a) => a -> a -> a` can be read as `max :: (Ord a) => a -> (a -> a)` which explains why type declarations are separated by arrows.
- Infix functions can be partially applied by using sections - surrounding it with parentheses
	- `(-5)` is an exception is just negative 5
- Function types need a mandatory parentheses because `->` is naturally right associative