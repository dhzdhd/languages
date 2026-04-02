# Haskell

## Features

- A purely functional PL (referential transparency, deterministic behaviour)
- Lazy (Calculates & executes when forced)
- Statically typed
- Type inference

## GHCI

- `:t` - typeof variable
- `:l` - load file
- `:m + Data.List Data.Map Data.Set` - load module

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

## Typeclasses & More types

```haskell
-- Typeclass defn
(==) :: (Eq a) => a -> a -> Bool  -- Eq or equality typeclass

-- Typeclass examples
(==) :: (Eq a) => a -> a -> Bool  -- Equality, members implement == & /=
(>) :: (Ord a) => a -> a -> Bool  -- Ordering, members implement >,<,>=,<=
show :: (Show a) => a -> String  -- Shown as strings
read :: (Read a) => String -> a  -- Opposite of Show, reads a string and returns a type which is a member of Read
Enum  -- Members are sequentially ordered types
Bounded  -- Have upper and lower bound
Num  -- Numeric typeclass, members act like numbers (take in ints and floats)
fromIntegral :: (Num b, Integral a) => a -> b  -- Num but only integral numbers
Floating  -- double & float

-- Algebraic data types (ADT)
data Bool = False | True  -- Defining a new type

data Shape = Circle Float | Rectangle Float Float deriving (Show)  -- makes part of Show typeclass
surface :: Shape -> Float  
surface (Circle r) = pi * r ^ 2  
surface (Rectangle x1 y1) = (abs $ x1 - y1) * (abs $ y1 - x1)

-- Records
data Person = Person { firstName :: String  
                     , lastName :: String  
                     , age :: Int  
                     } deriving (Show)
Person {firstName="", lastName="", age=5}

-- Type parameters
data Maybe a = Nothing | Just a
data (Ord k) => Map k v  -- Bad practice

-- Deriving typeclasses
data Person = Person { firstName :: String  
                     , lastName :: String  
                     , age :: Int  
                     } deriving (Eq)  -- All fields of type must be constrained by Eq
data Day = Monday | Tuesday | Wednesday | Thursday | Friday | Saturday | Sunday   
           deriving (Eq, Ord, Show, Read, Bounded, Enum)  -- Enum applied for successor & predecessor and Bounded for max, min bounds

-- Type synonyms
type String = [Char]  -- type alias, not a new type
type AssocList k v = [(k,v)]  -- Parameterized
type IntMap = Map Int  -- Partially applied (v)
```

- Sort of interface that defines behaviour. If a type is a part of a typeclass, that means that it supports and implements the behaviour the typeclass describes.
- `=>` is a **class constraint**. The type of values must be a member of the typeclass
- Creating types
	- We use the `data` keyword to create types.
	- `data A = B`
	- Here, `A` is the type name and `B` is called a value constructor. Both are capital
	- Value constructors can have fields which can contain values
	- These fields are actually params to the value constructors which are functions 
	- We can pattern match value constructors but not use them as types.
	- It's common to use the same name as the type if there's only one value constructor
- Records
	- Creates functions that can lookup fields in the type
	- Order does not matter
- Type parameters
	- Type constructors take types as parameters to produce new types. (Generics)
	- Type constructors can contain class constraints but this is not good practice as you will have to include the constraint in functions anyways.
- Derived types
	- Ex: When we derive the `Eq` instance for a type and then try to compare two values of that type with `==` or `/=`, Haskell will see if the value constructors match and then check data inside too

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

takeWhile (<10000) [1..]  -- Takes nums while predicate is true

-- Lambdas
zipWith (\a b -> (a * 30 + 3) / b) [5,4,3,2,1] [1,2,3,4,5]
map (\(a,b) -> a + b) [(1,2),(3,5),(6,3),(2,6),(2,5)]  -- With pattern matching

-- Folds
sum' :: (Num a) => [a] -> a  
-- sum' xs = foldl (\acc x -> acc + x) 0 xs
sum' = foldl (+) 0

elem' :: (Eq a) => a -> [a] -> Bool  
elem' y ys = foldl (\acc x -> if x == y then True else acc) False ys

map' :: (a -> b) -> [a] -> [b]  
map' f xs = foldr (\x acc -> f x : acc) [] xs  -- Left fold requires ++ which is costly

-- Function application
($) :: (a -> b) -> a -> b  
f $ x = f x

map ($ 3) [(4+), (10*), (^2), sqrt]

-- Function composition
(.) :: (b -> c) -> (a -> b) -> a -> c  
f . g = \x -> f (g x)

map (negate . abs) [5,-3,-6,7,-3,2,-19,24]
map (negate . sum . tail) [[1..5],[3..6],[1..7]]
(sum . replicate 5 . max 6.7) 8.9  -- Multiple param composition
fn = ceiling . negate . tan . cos . max 50  -- Point free style
```

- Functions that can take functions as parameters and return functions as return values are called higher order functions.
- Every fn in Haskell takes only one parameter. The functions that accept more are curried.
- `max :: (Ord a) => a -> a -> a` can be read as `max :: (Ord a) => a -> (a -> a)` which explains why type declarations are separated by arrows.
- Infix functions can be partially applied by using sections - surrounding it with parentheses
	- `(-5)` is an exception is just negative 5
- Function types need a mandatory parentheses because `->` is naturally right associative
- Lambdas are anonymous functions usually to pass them to a higher order function. They are expressions. Lambdas are normally surrounded by parentheses unless we mean for them to extend all the way to the right.
- A fold takes a binary function, a starting value (the accumulator) and a list to fold up. The resultant acc is returned. `foldl` starts from the left and `foldr` from the right.
- `scanl` & `scanr` are similar but report intermediate values in a list instead of the acc.
- Function application or `$` has the lowest precedence and right associative.

## Modules

```haskell
-- Imports
import Data.List

numUniques :: (Eq a) => [a] -> Int  
numUniques = length . nub  -- nub exists in Data.List and gets unique elements

import Data.List (nub, sort)
import Data.List hiding (nub)
import qualified Data.Map as M  -- Qualified imports (M.foo)

-- Data.List
intersperse '.' "MONKEY"  -- "M.O.N.K.E.Y"
intercalate [0,0,0] [[1,2,3],[4,5,6],[7,8,9]]  -- [1,2,3,0,0,0,4,5,6,0,0,0,7,8,9]
transpose [[1,2,3],[4,5,6],[7,8,9]]
concat [[3,4,5],[2,3,4],[2,1,1]]  -- [3,4,5,2,3,4,2,1,1]
and $ map (==4) [4,4,4,3,4]  -- False
or $ map (==4) [2,3,4,5,6,1]  -- True
any (==4) [2,3,5,6,1,4]
any (==4) [2,3,5,6,1,4]
iterate (*2) 1  -- Infinite multiples
group [1,1,2,2,2,2,3,3,2,2,2,5,6,7]  -- [[1,1],[2,2,2,2],[3,3],[2,2,2],[5],[6],[7]]
find (>4) [1,2,3,4,5,6]  -- Just 5
lines "first line\nsecond line"  -- ["first line","second line"]
[1..10] \\ [2,5,9]  -- [1,3,4,6,7,8,10] (List difference)
groupBy ((==) `on` (> 0)) values  -- Group by equality on condition - greater than zero

-- Maps / Association lists
phoneBook =   
    [("betty","555-2938")  
    ,("bonnie","452-2928")  
    ,("patsy","493-2928")  
    ]

findKey :: (Eq k) => k -> [(k,v)] -> Maybe v  
findKey key = foldr (\(k,v) acc -> if key == k then Just v else acc) Nothing

Map.null $ Map.fromList [(2,3),(5,5)]
Map.insert 5 600 . Map.insert 4 200 . Map.insert 3 100 $ Map.empty

-- Creating modules
module Geometry  
( Point(..)  -- Exported all constructors of a datatype
, Shape(Circle)
, sphereVolume  -- Exported functions
, sphereArea
) where
```

- A Haskell module is a collection of related functions, types and typeclasses.
- A Haskell program is a collection of modules where the main module loads up the other modules and then uses the functions defined in them.
- The `Prelude` module is imported by default.
- `import` has to be at the top of the file, before any fn definition
- `foldl'` and `foldl1'` are stricter versions of their respective lazy versions. When using lazy folds on really big lists, you might often get a stack overflow error. The culprit for that is because the accumulator value isn't actually updated as the folding happens. It makes a promise that it will compute its value when asked to actually produce the result (also called a thunk).
- Maps need keys to be orderable as they are internally represented by trees.
- All elements of a set are unique and ordered.
- Creating modules
	- The module name is the file name. Ex: `Foo`
	- If a module is present in a folder, it's a submodule. Ex: Foo/Bar implies `Foo.Bar`