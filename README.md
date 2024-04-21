<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Installation

Please ensure to check the dependencies first. If the vendor folder does not exist in the project, please run the command:
```
composer install
```
After confirming the dependencies, make sure to create an empty database in your MySQL server and set the database name in the .env file.

Then, execute the following command to ensure that the database has been created and sufficient data exists to proceed:

```
php artisan migrate:fresh --seed
```
Finally, you can run the project using the command:

```
php artisan serv
```

## Testing

You can use this collection on the postman application and run the collection and start testing

[POSTMAN COLLECTION File](/test.postman_collection.json)

## About Project

This Project focusing on managing and displaying customizable hotel inventory information from various sources. 
The system display different data based on the user's association with specific travel agencies.

## Project Structure

In this Project, we have these entities 

* Providers: provide properties
* Properties: each property can have various entries as hotels from different sources (Agencies) 
* Agencies: Agencies are the sellers selling hotel properties with a customized or default name.
* Hotel: the customized property data 
* User: who is associated/not associated with agencies and can see the hotel.

In this Project, we have 3 different types of guards, and each of them needs a separate JWT to access the system:

* Users (customers)
    * they can see the hotel availability with the associate agency 
    * they can see properties if they do not have agency
* Agencies
    * they can create entries for each property 
    * they can see all of their hotel entries
* Admins 
    * they can add agency
    * they can add provider
    * they can add property

## Contributing
Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
