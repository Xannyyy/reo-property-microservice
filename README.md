# Starting the project 

Starting the project is no more complicated than running the `php artisan config:cache` then after this the pre made seeders let you test it with ease so make sure to run migrate as such `php artisan migrate --seed`. There are two properties you can test with the one with id `1` and `2`. But also you can run the unit tests I have written with `php artisan test`. It includes a wide variety of ways you can match profiles.


### Project Structure

The project does not follow the standard MVC pattern, and it is also an API. We have the following structure. NOTE: Only non default laravel structure is explained.

- Domains:
  * The domains folder contains all our domains or to put it simple where all our logic code that has no integration outside resides. These are comprised of classes that just do logic and let's us unit test really easily without having to worry about heavy mocking. 
- Repositories:
  * The repositories folder contains all our repositories which connect to a outer source of data. In our case we have a mysql database. Even though Eloquent is a active record ORM we still use repository pattern to keep things centralized and easy to work with. It is not fully a "repository pattern" due to the model still being able to change itself outside of the repository but it gives us a good abstraction over the data layer.
- Services:
  * The services folder contains all our services which the sole purpose is for them to connect our other parts of the application. In our case it connects the repository and domains and creates some kind of result. With the use of services we keep our controllers clean and provide ourseves a easy way of writing integration tests.
- DTO:
  * The DTO folder contains all objects that serve as a way of type hinting functions. They are pure objects with just data in them and static methods to create themselves. We use static methods because a single object can be created from more than one source and it gives good naming availability.


### Some good practices

- If a class is supposed to have an interface always place them inside one folder.
- Try to format as much as possible with phps coding standard(I use phpstorm so it requires no pre configuration)
- Function and variable naming should be as concise and meaningful as possible
- Functions should remain relatively small or else extract into private methods with concise names
- Avoid leaving comments since at that point a function will have more than one source of truth
- Please improve this list if you see the need too!

