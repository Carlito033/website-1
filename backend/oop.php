<?php
/*
===============================================================================
UNDERSTANDING OBJECTS, METHODS, AND CONSTRUCTORS
===============================================================================

WHAT IS AN OBJECT?
-------------------
An object is a real-world thing that you want to represent in code.
Think of it like a physical item:
- A car is an object
- A person is an object
- A book is an object

An object has:
1. Properties (characteristics/attributes) - what it IS
2. Methods (actions/behaviors) - what it DOES

Real-world example:
- A CAR object has properties: brand, model, year, color, speed
- A CAR object has methods: start(), stop(), accelerate()

In PHP, objects are created from classes.
A class is like a blueprint or template for creating objects.

Example:
- Class: "Dog" (the blueprint)
- Object: "Buddy the dog" (the actual dog - an instance of the blueprint)


WHAT IS A METHOD?
------------------
A method is a function that belongs to an object/class.
It defines what an object can DO.

Real-world analogy:
- If properties are adjectives (what something IS)
- Then methods are verbs (what something DOES)

Example methods:
- Car.start() - starts the car
- Dog.bark() - the dog barks
- Person.walk() - the person walks

Methods can:
- Use object properties
- Take parameters (inputs)
- Return values (outputs)

Syntax:
public function methodName($parameter1, $parameter2) {
    // Code here
    return $someValue;
}


WHAT IS A CONSTRUCTOR?
-----------------------
A constructor is a special method that runs automatically when you create a new object.
It's used to SET UP or INITIALIZE the object.

Think of it like a birth or setup process:
- When you create a new person, you give them a name, age, and gender
- When you create a new car, you set its brand, model, and year

Constructor name in PHP: __construct()

Why use constructors?
- To set initial values for properties
- To prepare the object for use
- To ensure the object is valid from the start

Real-world analogy:
- Creating a bank account: Constructor sets initial balance
- Creating a user: Constructor sets username, email, password
- Creating a product: Constructor sets name, price, stock

Example constructor:
public function __construct($name, $age) {
    $this->name = $name;           // Set the name property
    $this->age = $age;             // Set the age property
}

When you write: $person = new Person("John", 25);
The constructor __construct("John", 25) automatically runs!


===============================================================================
PRACTICAL EXAMPLE: BANK ACCOUNT
===============================================================================
*/

class BankAccount {
    // Properties (attributes/characteristics)
    public $accountHolder;
    public $balance;
    public $accountNumber;
    public $accountType; // e.g., "Checking", "Savings"

    // Constructor - runs when creating a new object
    public function __construct($holder, $initialBalance, $accountNum) {
        echo "Creating new bank account...\n";
        $this->accountHolder = $holder;
        $this->balance = $initialBalance;
        $this->accountNumber = $accountNum;
        $this->accountType = "Checking"; // Default account type
        echo "Account created for $holder with balance \$$initialBalance\n\n";
    }

    // Method - deposit money
    public function deposit($amount) {
        $this->balance += $amount;
        return "Deposited \$$amount. New balance: \$" . $this->balance;
    }

    // Method - withdraw money
    public function withdraw($amount) {
        if ($amount > $this->balance) {
            return "Insufficient funds!";
        }
        $this->balance -= $amount;
        return "Withdrew \$$amount. New balance: \$" . $this->balance;
    }

    // Method - check balance
    public function checkBalance() {
        return "Account: " . $this->accountNumber . "\nHolder: " . $this->accountHolder . "\nBalance: \$" . $this->balance;
    }

    public function checkAccountType () {
        return "Account Type: " . $this->accountType;
    }
}

// Creating objects by calling the constructor
echo "--- Creating Bank Account 1 ---\n";
$account1 = new BankAccount("Alice", 1000, "ACC001");

echo "--- Using Methods on account1 ---\n";
echo $account1->deposit(500) . "\n";
echo $account1->withdraw(200) . "\n";
echo $account1->checkBalance() . "\n\n";

echo "--- Creating Bank Account 2 ---\n";
$account2 = new BankAccount("Bob", 500, "ACC002");

echo "--- Using Methods on account2 ---\n";
echo $account2->deposit(300) . "\n";
echo $account2->checkBalance() . "\n\n";


/*
===============================================================================
WHAT IS STATIC IN OOP?
===============================================================================

Static members (properties and methods) belong to the CLASS itself, not to individual OBJECTS.
Think of it like shared resources that all objects of that class can access.

KEY DIFFERENCES:
- Regular properties/methods: Each object has its own copy
- Static properties/methods: Shared by ALL objects of the class

WHEN TO USE STATIC:
- When you need data shared across all instances (like a counter)
- For utility functions that don't need object state
- For constants that apply to the entire class

SYNTAX:
- Static property: public static $propertyName;
- Static method: public static function methodName() {}
- Access: ClassName::$propertyName or ClassName::methodName()

REAL-WORLD ANALOGY:
- Regular: Each car has its own gas tank
- Static: All cars share the same road (the road is static)

EXAMPLE: Company Employee Counter
*/

class Employee {
    // Regular property - each employee has their own name
    public $name;

    // Static property - shared by ALL employees
    public static $totalEmployees = 0;

    // Regular property - each employee has their own salary
    public $salary;

    public function __construct($name, $salary) {
        $this->name = $name;
        $this->salary = $salary;

        // Increment the static counter when any employee is created
        self::$totalEmployees++;
        echo "Employee $name created. Total employees: " . self::$totalEmployees . "\n";
    }

    // Regular method - works on individual employee
    public function getInfo() {
        return "Name: $this->name, Salary: $$this->salary";
    }

    // Static method - works on the class level
    public static function getTotalEmployees() {
        return "Total employees in company: " . self::$totalEmployees;
    }

    // Static method - utility function
    public static function calculateBonus($salary, $percentage) {
        return $salary * ($percentage / 100);
    }
}

// Creating employees (each gets their own name and salary)
echo "--- Creating Employees ---\n";
$emp1 = new Employee("Alice", 50000);
$emp2 = new Employee("Bob", 60000);
$emp3 = new Employee("Charlie", 55000);

echo "\n--- Using Regular Methods (on specific objects) ---\n";
echo $emp1->getInfo() . "\n";
echo $emp2->getInfo() . "\n";

echo "\n--- Using Static Methods/Properties (on the class) ---\n";
// Access static method without creating an object
echo Employee::getTotalEmployees() . "\n";

// Access static utility method
$bonus = Employee::calculateBonus(50000, 10);
echo "Alice's 10% bonus: $$bonus\n";

// Access static property
echo "Total employees (via property): " . Employee::$totalEmployees . "\n";

echo "\n--- Key Point: Static is shared ---\n";
echo "emp1 total employees: " . $emp1::$totalEmployees . "\n"; // Same value
echo "emp2 total employees: " . $emp2::$totalEmployees . "\n"; // Same value
echo "Class total employees: " . Employee::$totalEmployees . "\n"; // Same value


/*
===============================================================================
STATIC VS NON-STATIC COMPARISON
===============================================================================

Non-Static (Instance) Members:
- Belong to individual objects
- Need an object to access: $object->property or $object->method()
- Each object has its own copy
- Example: $car1->color vs $car2->color

Static Members:
- Belong to the class
- Can access without creating object: ClassName::method()
- Shared across all objects
- Example: Car::$totalCars (same for all car objects)

COMMON USES FOR STATIC:
1. Counters (total users, total products)
2. Configuration settings
3. Utility/helper functions
4. Constants
5. Factory methods

===============================================================================
SIMPLE ANALOGY TABLE
===============================================================================

Real World          | OOP Concept       | Example
--------------------|-------------------|---------------------------

Real World          | OOP Concept       | Example
--------------------|-------------------|---------------------------
Dog breed blueprint | Class             | class Dog {}
One specific dog    | Object/Instance   | $myDog = new Dog()
Dog's color, age    | Property          | $myDog->color = "brown"
Dog's ability       | Method            | $myDog->bark()
Birth/setup         | Constructor       | __construct()
--------------------|-------------------|---------------------------

KEY TAKEAWAYS:
1. Objects are things with properties and methods
2. Methods are functions that define what an object can do
3. Constructors initialize objects when they're created
4. You create objects from classes using: $object = new ClassName();


===============================================================================
MORE EXAMPLES BELOW
===============================================================================

Object-Oriented Programming (OOP) in PHP: Key Concepts with Examples

OOP is a programming paradigm that uses objects and classes to structure code. It promotes modularity, reusability, and maintainability.

1. Classes and Objects:
   - A class is a blueprint for creating objects.
   - An object is an instance of a class.

Example: A simple Car class.
*/

class Car {
    // Properties (attributes)
    public $brand;
    public $model;
    public $year;

    // Constructor: Initializes the object
    public function __construct($brand, $model, $year) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
    }

    // Method (behavior)
    public function displayInfo() {
        return "This is a {$this->year} {$this->brand} {$this->model}.";
    }
}

// Creating objects (instances)
$car1 = new Car("Toyota", "Corolla", 2020);
$car2 = new Car("Honda", "Civic", 2021);

echo $car1->displayInfo() . "\n"; // Output: This is a 2020 Toyota Corolla.
echo $car2->displayInfo() . "\n"; // Output: This is a 2021 Honda Civic.

/*
2. Encapsulation:
   - Hiding internal details and exposing only necessary parts.
   - Use private/protected properties and public methods to access them.

Example: Encapsulation with private properties.
*/

class BankAccountPrivate {
    private $balance;

    public function __construct($initialBalance) {
        $this->balance = $initialBalance;
    }

    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
        }
    }

    public function getBalance() {
        return $this->balance;
    }
}

$accountPrivate = new BankAccountPrivate(1000);
$accountPrivate->deposit(500);
echo "Balance: $" . $accountPrivate->getBalance() . "\n"; // Output: Balance: $1500

/*
3. Inheritance:
   - A class can inherit properties and methods from another class.
   - Promotes code reuse.

Example: ElectricCar inherits from Car.
*/

class ElectricCar extends Car {
    public $batteryCapacity;

    public function __construct($brand, $model, $year, $batteryCapacity) {
        parent::__construct($brand, $model, $year); // Call parent constructor
        $this->batteryCapacity = $batteryCapacity;
    }

    // Override method
    public function displayInfo() {
        return parent::displayInfo() . " It has a {$this->batteryCapacity} kWh battery.";
    }
}

$electricCar = new ElectricCar("Tesla", "Model S", 2022, 100);
echo $electricCar->displayInfo() . "\n"; // Output: This is a 2022 Tesla Model S. It has a 100 kWh battery.

/*
4. Polymorphism:
   - Ability to take many forms. Methods can behave differently based on the object.

Example: Using the same method name with different implementations.
*/

class Animal {
    public function makeSound() {
        return "Some sound";
    }
}

class Dog extends Animal {
    public function makeSound() {
        return "Woof!";
    }
}

class Cat extends Animal {
    public function makeSound() {
        return "Meow!";
    }
}

$animals = [new Dog(), new Cat()];
foreach ($animals as $animal) {
    echo $animal->makeSound() . "\n"; // Outputs: Woof! Meow!
}

/*
5. Abstraction:
   - Hiding complex implementation details and showing only essential features.
   - Use abstract classes or interfaces.

Example: Abstract Shape class.
*/

abstract class Shape {
    abstract public function area();
    abstract public function perimeter();
}

class Circle extends Shape {
    private $radius;

    public function __construct($radius) {
        $this->radius = $radius;
    }

    public function area() {
        return pi() * $this->radius * $this->radius;
    }

    public function perimeter() {
        return 2 * pi() * $this->radius;
    }
}

$circle = new Circle(5);
echo "Area: " . $circle->area() . "\n"; // Output: Area: 78.539816339745
echo "Perimeter: " . $circle->perimeter() . "\n"; // Output: Perimeter: 31.415926535898

/*
These examples demonstrate the core OOP principles. Practice by modifying and extending them.
For more advanced topics, explore interfaces, traits, and design patterns like Singleton (as in database.php).
*/
?>
