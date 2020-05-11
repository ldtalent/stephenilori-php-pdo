![Login Page](https://res.cloudinary.com/dw0donhwr/image/upload/v1589046260/Screenshot_from_2020-05-06_17-21-50_r2aeb7.png)

In this tutorial, I’ll show you how to create a simple login and signup system using PHP'S PDO in an Object-Oriented Fashion. PHP has a reputable number of Api's for communicating with the Mysql database but for this lesson, we would be using PDO to communicate with our Mysql database.

## Project Requirements
In order to get the best out of this lesson, the following requirement needs to be satisfied.

1. A Localhost Server: You can download the latest version of any of the following. XAMPP, LAMPP, MAMPP, AMPPS depending on your operating system.

2. A text editor: A text editor to write your codes with. Personally, I will recommend you download [Vs Code](https://code.visualstudio.com/).

3. A Css Framework: A Css framework such as MaterializeCss, Bootstrap4, or SkeletonCss. It all depends on whichever Css framework you prefer but for this lecture, I recommend [Bootstrap](https://getbootstrap.com/). 

4. Basic Knowledge of PHP.

5. Download the Mysql Database from [Github](https://github.com/learningdollars/stephenilori-php-pdo). 

With the requirements all satisfied, we can then now take some time to talk about PDO (PHP DATA OBJECTS).

>The PHP Data Objects (PDO) extension defines a lightweight, consistent interface for accessing databases in PHP. Each database driver that implements the PDO interface can expose database-specific features as regular extension functions. Note that you cannot perform any database functions using the PDO extension by itself; you must use a database-specific PDO driver to access a database server.

>PDO provides a data-access abstraction layer, which means that, regardless of which database you're using, you use the same functions to issue queries and fetch data. PDO does not provide a database abstraction; it doesn't rewrite SQL or emulate missing features. You should use a full-blown abstraction layer if you need that facility.

>PDO ships with PHP 5.1, and is available as a PECL extension for PHP 5.0; PDO requires the new OO features in the core of PHP 5, and so will not run with earlier versions of PHP.

Back to our project, it's high time we get our hands dirty and write some codes. In your localhost htdocs, www, or html directory, we would create a new folder to house our application. You can name the folder whatever you want.

Inside of the just created folder, we should have a working directory that looks like the following.

### Project Directory 

    */ ld-auth (Parent Folder or Project)
        */ assets (Our Css And Js Lives Here)
            */ css
        */controller
            /Controller.php
            /Dashboard.php
            /Login.php
            /Logout.php
            /Register.php
        */Model
            /DashboardModel.php
            /Db.php
            /LoginModel.php
            /RegisterModel.php
        dashboard.php
        index.php
        logout.php
        nav.php
        register.php    

## Editing Our Db.php (Model Folder)

In the Model folder, our Db.php file would be holding all the necessary configurations needed to establish a connection with our Mysql database. 

Our Db.php file is also acting as a base class for every other classes in the Model Folder.

With that said, our Db.php should contain the following.

[gist]948637689a3c85010e75b4f1888e7d4e[/gist]

Our class contains some protected properties which we would be making use of in creating our DSN (Data Source Name) which is required for creating a new PDO connection.

>A data source name (DSN) is a data structure that contains the information about a specific database that an Open Database Connectivity ( ODBC ) driver needs in order to connect to it.

### The __construct() Magic Method

All the magic happens in our __construct magic method, where our Dsn was created alongside some sane configs / attributes for our PDO connection.

1. PDO::ATTR_PERSISTENT: This attribute is responsible for creating a persistent database connection. You can visit the [php.net website](https://www.php.net/manual/en/features.persistent-connections.php) to learn more about persistent database connection.

2. PDO::ATTR_ERRMODE: This attribute determines how an exception or an error is handled when an exception is thrown while the PDO object tries making or handling some requests with the database server.

You can visit the [php.net website](https://www.php.net/manual/en/pdo.setattribute.php) to learn more about the different attributes associated with PDO.

With that explanation out of the way now, A new database connection was created and passed to the **Db Class** protected **$dbHandler** property which makes it possible to reference the created database connection in the current Class methods and other Classes which extends the **Db Class**.

We could have just gotten lazy and use the database connection created from the PDO instance without extending it further but that would probably make the application difficult to maintain becuase we would be referencing a lot of PDO methods in different files which is not really DRY (Don't Repeat Yourself).

So, in order to tackle that, using an *Object Oriented Approach* works best here because we have all the PDO methods in one place which provides a decent level of abstraction as we only need to call methods available in the **Db Class** to achieve a particular task.

>Abstraction is selecting data from a larger pool to show only the relevant details of the object to the user. Abstraction “shows” only the essential attributes and “hides” unnecessary information. It helps to reduce programming complexity and effort. It is one of the most important concepts of OOPs.

### The Query Method

The **query** method which accepts a single arguement and returns null or void is responsible for reusing the database connection which was created and passed over to the **$dbHandler** protected variable. 

which is then now used in invoking the prepare method which accepts the string from the **query** method. A statement object is created and then passed on to another protected property **$dbStmt**.

From the [php.net website](https://www.php.net/manual/en/pdo.prepare.php), The line below best explains the prepare method.

> Prepares an SQL statement to be executed by the PDOStatement::execute() method. The statement template can contain zero or more named (:name) or question mark (?) parameter markers for which real values will be substituted when the statement is executed. Both named and question mark parameter markers cannot be used within the same statement template; only one or the other parameter style. Use these parameters to bind any user-input, do not include the user-input directly in the query.

### The Bind Method

The **bind** method accepts 3 parameters, **$param**, **$value**, and **$type**. The method then runs a switch statement if the **$type** is empty in order to bind the correct data type to **$type**.

Available PDO Data Types:

1. PDO::PARAM_BOOL: Represents a boolean data type.

2. PDO::PARAM_NULL: Represents the SQL NULL data type.

3. PDO::PARAM_INT: 	Represents the SQL INTEGER data type.

4. PDO::PARAM_STR: Represents the SQL CHAR, VARCHAR, or other string data type.

The **bind** method also makes an attempt to bind the correct vaues to the _? or : placeholder_ 

According to google, 

> The PDOStatement::bindValue() function is an inbuilt function in PHP which is used to bind a value to a parameter. This function binds a value to corresponding named or question mark placeholder in the SQL which is used to prepare the statement.

### The Execute Method

The **execute** method receives no parameters and returns a boolean true or a boolean false. This method attempts to invoke or call PDO's **execute** method which executes a prepared statement. 

> PDOStatement::execute returns a boolean true on success or a boolean false on failure.

### The Fetch Method

The **fetch** method invokes the **Db Class** **execute** method which executes the generated PDO prepared statement and the **fetch** method also calls another PDO method called **fetch** which takes a single parameter which determines how the result is processed and returns it using the format passed in as an arguement.

You can visit the [php.net website](https://www.php.net/manual/en/pdostatement.fetch.php) to read the full docs.

### The FetchAll Method

The **fetchAll** method also invokes the **Db Class** **execute** method which was explained earlier. The only difference is that the **fetchAll** method calls a PDO method called **fetch_all** on the prepared statement which takes a single arguement and returns a list containing all of the matched records from the database depending on the prepared statement condition.

You can visit the [php.net website](https://www.php.net/manual/en/pdostatement.fetchall.php) to read the full docs.

## Editing Our LoginModel.php (Model Folder)

The LoginModel houses a class which extends the **Db Class** from the Db.php file in the Model Folder. 

The LoginModel Class contains a single method which searches for a user based on an email address and returns an array. 

Open the LoginModel.php file and paste the code snippet below.

[gist]08b5c5f77270f2d193b07d8a64582b96[/gist]

### The FetchEmail Method

The **fetchEmail** method takes an **$email** as it's only parameter and returns an array depending on the result of it's previous operation. The **fetchEmail** function makes use of the **Db Class** methods such as 

1. The query method.

2. The bind method.

3. The execute method.

4. The fetch method.

## Editing Our RegisterModel.php (Model Folder)

The **RegisterModel** file extends the **Db Class** which is required at the top of the file. The RegisterModel Class has two methods createUser and fetchUser which is responsible for creating a new user and returning a new user.

Your RegisterModel.php file shoud contain the following code snippet.

[gist]56289db582b8123c5e5bb817353d3a5e[/gist]

### The CreateUser Method

The **createUser** method accepts an array as it's only parameter and returns an array depending on the result of the Database operation. The **createUser** method makes use of the following methods from the **Db Class**.

### The FetchUser Method

The **fetchUser** method accepts an email string as it's only parameter and returns an array containing a user with the email depending on the result of the Database operation. The method returns a user resource with the email address.

## Editing The DashboardModel.php (Model Folder)

The DashboardModel.php file houses the **Db Class** from the Db.php file. The DashboardModel extends the **Db Class** and makes use of the method provided from the **Db Class** in it's own fetchNews method which returns an array of news.

With that said, Our DashboardModel.php file should like the line below.

[gist]bb357d43eeb01489aeaf7387bcf12a03[/gist]

### The FetchNews Method

The fetchNews method receives no arguement or parameter but returns an array of news by making use of the methods provided in the **Db Class**.

## Editing The Controller.php (Controller Folder)

This file acts as a base Controller for other Controllers in the Controller folder as this makes it easier to reuse methods since other Controllers extends the base Controller. 

The Controller.php file should look like the line below.

[gist]7e80a850fefb6983bfe7c7455092f202[/gist]

This Class doesn't do much only that it starts or resumes an existing session. which can then now be taken advantage of in other Classes or Controllers that extends the Controller.php

## Editing The Dashboard Controller

This file houses a class called Dashboard Controller which extends the base Controller. The file also loads in some dependencies by requiring the DashboardModel we created earlier for fetching news. 

With that said, Our Dashboard.php file should look like the following. 

[gist]4c67ab613c2ca220ff492343633a2016[/gist]

### The __construct Magic Method

This method is executed as soon as an instance of the Dashboard Class is created. This method checks if the *auth_status* key is set in the session array and creates a new instance of the DashboardModel class if it exists else it performs an http redirect to the login page.

### The GetNews Method 

This method makes use of the private **$dashboardModel** property which is an instance of the DashboardModel Class. The **$dashboardModel** exposes the methods available in the DashboardModel Class which makes it easier to get the list of news.

## Editing The Login.php (Controller Folder)

This file houses a class called Login Controller which extends the base Controller. The file also loads in some dependencies by requiring the LoginModel for fetching a user based on the user email address. 

With that said, Our Login.php file should look like the following. 

[gist]021e34c23dedac23fa148aaa22272423[/gist]


### The __construct Magic Method

This method is executed as soon as an instance of the Login Class is created. This method creates a new instance of the LoginModel class which is passed to the private **$loginModel** data property.

### The Login Method 

This method handles all the business logic for authenticating a user. The method receives an array and returns an array if the user fails authentication else an Http Redirect is returned.

## Editing The Register.php (Controller Folder)

This file houses a class called Register Controller which extends the base Controller. It also requires the RegisterModel as a dependency. which is instantiated when a new instance of the Register Class is created.

With that said, The Register.php should look like the line below.

[gist]497da117da502790e25264947fcc836e[/gist]

### The __construct Method

This method creates a new instance of the RegisterModel class and passes the object to the Register Class protected **$registerModel** property.

### The Register Method

This method handles all the business logic for creating a new user. The method receives an array and returns an array if the user fails veification else an Http Redirect is returned and a new session is created for the user.


## Editing The Logout.php (Controller Folder)

This file houses a class called Logout Controller which extends the base Controller.

With that said, The Logout.php should look like the line below.

[gist]e69ce26428ce47540e3432b385ef2f58[/gist]

### The __construct Magic Method

The __construct method destroys the application's session and performs an HTTP Redirect to the login page.


## Creating Our View Files

Since, the Controllers and the Models has been created successfully, we can now begin creating our view files. The view files are going to live in the project's root diretory. 

This is not really the best approach but for a bigger application you would probably want to keep the view files in a seperate folder to keeps things neat and professional. 

This is basically going to be a simple HTML form with some alerts to display errors.

### Editing The Nav.php (Root Dir)

The nav.php would be serving as our view's base navigation. All other view would be extending the nav.php. In our nav.php, we have a simple PHP code island that prints the title of the current file and highlights the current active file. 

With that said, our nav.php file should look like the following.

[gist]9c3f0f3127fa829d6b0e7bd438a44b8a[/gist]


### Editing The Index.php (Root Dir)

The index.php file acts as our login page as you will find it requires the Login Controller Class at the top of the file. A new instance of the class is created and the login method is only called when an HTTP POST Request is made.

With that explanation, copy the following code snippet into the index.php file.

[gist]37abe3ae78110b6f991628023d27de00[/gist]

### Editing The Register.php (Root Dir)

The register.php file contains the HTML form for creating a new user. The Register Controller Class is requried at the top of the file. A new instance of the class is created and the register method is only called when an HTTP POST Request is made.

If the user fails validation, the errors is passed down to the **$Response** variable which is rendered conditionally by checking for a key in the array.

The register.php file should look like the line below.

[gist]86acd297cafb6497722ae41d3b6c6f5f[/gist]


### Editing The Dashboard.php (Rot Dir)

The dashboard view is where users are redirected to after a successfull login or signup request. It requires the Dashboard Controller Class and creates an instance of the class which fires the getNews method in order to fetch all saved news.

The dashboard.php file should look like the line below.

[gist]7b0b755e5edfd3113ee2aa543ceb3a99[/gist]


### Editing The Logout.php (Root Dir)

The logout file is where the user session is destroyed and a redirect is initiated back to the index.php view.

With that said, the logout.php file should look like the line below.

[gist]2ab1da83718c3b8df5ee44bb2c8490ed[/gist]


## Learning Tools

There is a lot of learning tools online. But in case you are looking, I recommend the following 

1. A crash course on youtube covering PDO with Brad Traversy [Youtube](https://www.youtube.com/watch?v=kEW6f7Pilc4).

2. The PHP official website [php.net](https://www.youtube.com/watch?v=kEW6f7Pilc4).

3. A crash course on youtube covering OOP with Brad Traversy [Youtube](https://www.youtube.com/watch?v=dQxuYRNbL_M).


## Learning Strategy

I used the learning tools above and a few PDF documentations to achieve this. Anytime I face some bugs, I would use stack overflow to check for solutions. But watching those videos helped a lot. I recommend that you do also.


## Reflective Analysis

It was a simple process for me. I just wanted to show you how simple achieving a login and signup system can be. In order to get more knowledge, I would recommend that you edit the registration process to send a mail to the user before activating the user account.

I also recommend that you edit the login process so it's only users with verified account that can log in. You can also go ahead to create a router to restrict access to our Model and our Controller directory. 


## Conclusion

The project mainly focus on the Db.php file as that is where our PHP PDO operations can be found. Other files like our model files extends the **Db Class** from the Db.php file. 

It could have been a lot easier creating or making PDO operations in our Controller files but that would be very messy. So, we adopted an Object Oriented Approach which also introduces seperation of concerns as our Model file lives in the Model and our Controller files lives in the Controller folder.

In order to improve this project, I would recommend that you include an .htaccess file to restrict access to the Model and the Controller directory. You could also integrate Email activations for the application which would force the user to activate his / her email address in order to continue.

[Get the complete project from github](https://github.com/learningdollars/stephenilori-php-pdo).