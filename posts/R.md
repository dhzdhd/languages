# R

## Introduction

- R is an integrated suite of software for data manipulation, graphical calculations, etc
- The language included in R is S lang

```r
# Help functions
help(func)
?func
example(func)

# Delimiter
a();
a() # Newline

# Using files
source("main.r")

# Objects
objects() # List all
rm(a, b) # Delete
```

- Commands consist of
	- Expressions - evaluated, printed, value lost
	- Assignments - same as above but stored in a variable
- All entities in R are objects
	- Can be stored in a file for future use

## Simple manipulations

```r
# Vector - ordered collection of numbers
x <- c(2, 34, 5) # Concat function
x <- 2 # Vector of length 1

# Assignments
x <- 5
5 -> x
x = 5
assign("x", 5)

# Operators
+, -, *, /, ^

# Functions
log, exp, cos, sin, sqrt, max, min
mean, var
sum, prod
sort, order

# Complex
sqrt(-1) # Error
sqrt(-1 + 0i)

# Regular sequences
1:30 # Inclusive
30:1
seq(1, 30)
seq(from=1, to=30, by=0.2)

# Booleans
TRUE, FALSE

# Null
NA
is.na(x)
(x == NA) !=(is.na(x))

# NaN
NaN
is.na(x)
is.nan(x)

# Char vectors
"a"
'a'
paste(c("x", "y"), 1:2, sep="") # ("x1", "y2")

# Index vectors
# Logical
x[is.na(x)] # Only true selected & new obj created
# I+
x[5]
x[1:10]
# I-
x[-(1:5)] # Excludes values unlike py
# Char str (Needs names attribute)
fruit = c(5, 10)
names(fruit) = c("orange", "banana")
lunch = fruit["orange"]


```

- Vector ops performed element by element
- Need not be of same length
	- Shorter vectors recycled 
	- Result is longest vector size
- Logical vectors are coerced into numeric vecs in normal arithmetic
- `NA` is not a value, only a marker for a quantity that is not available
- Index vectors are of 4 types
	- Logical
	- Vector of $\mathbb I^+$ 
	- Vector of $\mathbb I^-$
	- Vector of char strings

## Objects

```r
# Empty vec
character(0)
numeric(0)

# Intrinsic attr
mode(x)
length(x)
attributes(x)

# Conversion
as.character()
as.integer()

# Changing length
e = numeric()
e[3] = 17 # Length = 3, first two are NA
length(e) = 2

# Class
x # Say it is of class data.frame
unclass(x) # Prints like a matrix instead of a df
```

- Intrinsic attributes
	- Mode
	- Length
- Mode is basic type of fundamental constituents
- Vectors (Atomic structure)
	- Are of the same mode (datatype)
	- Exception is `NA`
	- Empty vec can also have mode
- Lists (Recursive structure)
	- Need not be of same mode
- Class is a special attr all objects contain as reported by the function `class`

## Factors

```r
# Factors
state <- c("tas", "sa", "qld", "nsw", "nsw", "nt", "wa", "wa",
"qld", "vic", "nsw", "vic", "qld", "qld", "sa", "tas",
"sa", "nt", "wa", "vic", "qld", "nsw", "nsw", "wa",
"sa", "act", "nsw", "vic", "vic", "act")
a <- factor(state)
a 
# [1] tas sa qld nsw nsw nt wa wa qld vic nsw vic qld qld sa
# [16] tas sa nt wa vic qld nsw nsw wa sa act nsw vic vic act
# Levels: act nsw nt qld sa tas vic wa
levels(a) # "act" "nsw" "nt" "qld" "sa" "tas" "vic" "wa"

incomes <- c(60, 49, 40, 61, 64, 60, 59, 54, 62, 69, 70, 42, 56,
61, 61, 61, 58, 51, 48, 65, 49, 49, 41, 48, 52, 46,
59, 46, 58, 43)
incmeans <- tapply(incomes, a, mean)
# act nsw nt qld sa tas vic wa
# 44.500 57.333 55.500 53.600 55.000 60.500 56.000 52.250


```

- Factor is a vector object used to specify discrete grouping of components of other vec of same length
- `tapply` applies a function to group of components

## Arrays & Matrices

```r
# Array
dim(z) = c(3, 5, 100) # z is a vector
x <- array(1:20, dim=c(4,5))

# Indexing
a[2]
a[2, , ]

# Matrix indices (Negatives not allowed)
i <- array(c(1:3,3:1), dim=c(3,2))
x[i] <- 0

# Outer product
ab <- a %o% b
ab <- outer(a, b, "*") # Theta join
```

- Array is a multiply subscripted collection of data entries
- Vector can be used as arr if it has a dimension vector assigned to `dim` attribute
- Values in data vector are column major
- Mixed vector recycling
	- Expr scanned LTR
	- Short vec extended by repeating values
	- A vec operand longer than matrix/array generates error
- Outer product
	- Dimensions are concatenated
	- Vector formed by all possible products