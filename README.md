# Stove Project

The system is a web application that provides CRUD functionality for managing users, stovens, addresses, states, and cities. Users can register, log in, and manage their profile, while stoven data is used to manage front-end data. Stovens have a one-to-many relationship with addresses, and states and cities are related entities for managing address information. The system allows users to create, read, update, and delete entities with validation and error handling, ensuring data integrity and enforcing relationships.

## Repositories: 

### [PHP Version](https://github.com/wladiveras/php-version) | [Laravel Version](https://github.com/wladiveras/laravel-version)

### **Steps todo:**

All steps todo and some tips to run all project workflow, don't forget to use postman **environments** and setup a **{{port}}** variable with 8000 or 8001 to choice which project you want to use.



###### Setup PHP Only version:

1.  First of all, setup your [laravel version](https://github.com/wladiveras/laravel-version) and do all steps.

2.  Go to php-only project root folder
    
3.  Setup `config/setup.php` file to your database settings like in laravel
    
4.  Start server running `php -S localhost:8001 -t public` in project root
    

###### Tips:

-   Both project use same database, so you need to start laravel version first, run migrations and seeders to create tables and data.
    
-   **OnlyPHP:** examples version only works to php only cause i build a sistem to get by query instend passing it by router like laravel, so when existing a example with Only PHP, use it only in PHP Version instend original version.
    

> When testing a project, make sure to update the port number to match your project's configuration. For example, if you are testing a Laravel application, you should change **{{port}}** to **8000** in the environments. If you are testing a PHP version only, you can use **8001** instead. _This will ensure that your project runs correctly and communicates with the correct project._

> **Laravel Version Port:** 8000 
> **PHP Version Port:** 8001

#

<p align="center">
<img src="https://imgs.search.brave.com/C1slrIwN6UmQAxuz63nThULuiRDW3H_gT5t3FpDfcew/rs:fit:860:0:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvY29tbW9ucy9j/L2MyL1Bvc3RtYW5f/KHNvZnR3YXJlKS5w/bmc"/>


<a  href="https://www.postman.com/wladiveras/workspace/portal/collection/10368732-f2ff3dc8-7246-496f-b132-1ecfb508cffe?action=share&creator=10368732&active-environment=10368732-8517dacc-80ac-45ae-b0fa-c7ecb4c1f772">Check out project collection</a>

<b>Postman Environments</b>
<img src="https://content.pstmn.io/b0d410f1-610d-45c8-af1d-076dfd4be910/aW1hZ2UucG5n" />
</div>