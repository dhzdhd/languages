# Java

- Java is a statically typed, OO, platform independent programming language

## Data types

```java
// Datatypes
short a = 5;  // 2 bytes
int a = 5;  // 4 bytes
long a = 5;  // 8 bytes
float a = 5.0f;  // 4 bytes
double a = 5.0;  // 8 bytes
byte a = 1;  // 1 byte
boolean a = true;  // 1 byte
char a = 'h'  // 2 bytes

// Autoboxing
Integer i = 1;
```

- Two types
	- Primitive - basic data types that store simple data on the stack
	- Reference - contain references to values and/or other objects or the special value `null`
- Autoboxing
	- Each primitive has a full class implementation that can wrap it. Java can do the conversion automatically - autoboxing

## Variables

```java
int a;  // Default is 0
```

- Default value for all primitives is 0, `false` for booleans, `\u0000` for char
- If the variable is defined in a method, we must assign a value before we can use it.
- `float/double` overflow results in `Infinity` whereas integers wrap around.
- An identifier 
	- Cannot be a reserved keyword
	- Can start with only $, _ or an alphabet

## Control structures

```java
// if else
if () {}
else if () {}
else {}

// switch case
switch () {
	case: {
		break;
	}
	default: {}
}

// while loop
while () {}
do {} while ()

// for loop
for (int i = 0; i < 10; i++) {}

for (int i : arr) {}
for (Entry<String, Integer> entry : map.entrySet()) {
    entry.getKey();
    entry.getValue();
}

List<String> arr = new ArrayList<>();
arr.forEach(item -> item);

// Labelling
outer: for (;;) {
	inner: for (;;) {}
}
```

## Classes

```java
// Defn
class Car {
    // Fields
    String type;
    String speed;

    // Constructor
    Car(String type, String speed) {
        this.type = type;
        this.speed = speed;
    }
    
    // Methods
    int increaseSpeed(int increment) {
        this.speed = this.speed + increment;
        return this.speed;
    }
}

// Instance
Car focus = new Car("Ford", "Focus", "red");
focus.increaseSpeed(5);
```

- Class properties are described by fields, which contain the state of objects of the class, and its behavior is described using methods.
- Every class has an empty constructor be default which initializes all fields with default values. (String to null)
- While classes are translated during compile time, objects are created from classes at runtime which are instances of classes.
- Access modifiers
	- public - anywhere
	- private - same class only
	- default - same package only (default)
	- protected - same class and subclasses only
	- ![[Pasted image 20240819195420.png]]

## Collections

```java
// Arrays
int[] numbers = new int[100];  // Empty list that can contain 100 elements
numbers = {1, 2, 3};
```

## Packages

```java
// Defn
package com.example.user;

// Usage
import com.example.user.*;
import com.example.user.HelloWorld;
```

- Packages are used to group related classes, interfaces and sub-packages.
- Helps in avoiding name collision and access control
- It is recommended to put each new type in a package. If not, they are part of the default package
	- We lose the benefits of having a package structure and we can’t have sub-packages
	- We can’t import the types in the default package from other packages
	- The `protected` and `package-private` access scopes would be meaningless
- Naming
	- All lower case
	- Period delimited
	- Reversed domain + sub package name
- In case of a name conflict, use the fully qualified name

## Program structure

```java
public class SimpleAddition {
    public static void main(String[] args) {
        int a = 10;
        int b = 5;
        double c = a + b;
        System.out.println( a + " + " + b + " = " + c);
    }
}
```

- The basic unit of a Java program is a class
- For a class to be executable, it needs a `main` method
- The `args` in the `main` method is the command-line arguments
- We can define more the one `main` method in an application but we have to specify which method the JVM uses with a `MANIFEST.MF` file

## Execution

```shell
javac SimpleAddition.java
java SimpleAddition
```

- We first compile the source code to generate the bytecode (`.class` file) using `javac`
- Then execute the bytecode using `java`