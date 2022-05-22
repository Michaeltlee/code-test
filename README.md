Hello, YOUR NAME!

Hello, Michael! Thank you for considering joining the Lawline team. Below is a coding exercise that will allow you
to highlight your skills.

You have up to 48 hours to submit, however, we respect your time and expect this to only take a few hours. Please make
commits regularly so we can track your progress.

### Getting Started

1. Fork this repository on Github
2. Update the first line of this README with your name (so that it reads "Hello, YOUR NAME!"). Commit this change. This
will serve as a starting timestamp
3. Complete the exercise below
4. Commit progress regularly
5. When you're done, commit all your code except any dependencies
6. Email Oi [oiwomark@furthered.com](mailto:oiwomark@furthered.com) with any questions/issues

### Requirements

- You have up to 48 hours to submit
- [x] Create a simple RESTful API written in Laravel (latest version)
    - [x] All responses should be JSON
    - [x] All requests should be JSON
- Simple UI Interface implemented in a JS Framework (plus if Vue)

## The Exercise

The exercise consists of **users**, **subscriptions** and **products**. A user will have the ability to add & remove
products within their account. A user must have an active subscription to add a product to their account.

#### Users

Each user must have, but is not limited to:

- [x] ID
- [x] First Name
- [x] Last Name
- [x] Email (unique)

**Please note:**

- These users are the only users that are able to make requests via the API.
- User creation/maintenance is not done through the API (see Database section below).
- [x] Users can own many products

#### ProductUser Pivot

product_user

- [x] id
- [x] user_id
- [x] product_id

#### Products

Each product must have, but is not limited to:

- [x] ID
- [x] Name
- [x] Description
- [x] Price
- [x] Image

#### Database

- MySQL
- All tables in the database must be created programmatically
- The user table should be seeded with at least five users
    - [ ] Run `php artisan db:seed` to seed the database with 10 users.

#### Authentication

You must implement an authentication system so that the API knows which of the users is making the request. 

- [x] All requests should ensure that an authorized user is making the request. In the event of an unauthorized user, an error should be thrown.

#### Requests

The following requests should be implemented:
- [x] Add product
    - [x] All fields required except ID and image
- [x] Update product
    - [x] All fields required except image
- [x] Delete product
- [x] Get product
- [x] Upload product image
- [x] Get list of all products
- [x] Attach a product to requesting user
    - [x] User must have an active subscription
- [x] Remove product from requesting user
- [x] List products attached to requesting user

| Description                               | Route                                     | Method | Notes                                   |
| :---------------------------------------- | :---------------------------------------- | :----- | :-------------------------------------- |
| Add product                               | `/api/product`                            | POST   | All fields required except ID and image |
| Update product                            | `/api/products/{product}`                 | PUT    | All fields required except image        |
| Delete product                            | `/api/products/{product}`                 | DELETE |                                         |
| Get product                               | `/api/products/{product}`                 | GET    |                                         |
| Upload product image                      | `/api/products/{product}/image`           | POST   |                                         |
| Get list of all products                  | `/api/products`                           | GET    |                                         |
| Attach product to requesting user         | `/api/users/products/{product}`           | POST   |                                         |
| Remove product from requesting user       | `/api/users/products/{product}`           | DELETE |                                         |
| List products attached to requesting user | `/api/users/products`                     | GET    |                                         |

### UI

Create a simple ui interface, written in your favorite JS Framework (Preferred: VueJS) for a user to

- [x] View all available products

**Bonus*
- [x] Authenticate
- [ ] Add/Remove products
- [ ] Writing tests (both backend and frontend) to backup your code is a huge plus

## Completion

When you are finished, you will push up the application to a personal git repo. Then please notify Oi via email
[oiwomark@furthered.com](mailto:oiwomark@furthered.com?subject=Lawline%20Code%20Challenge) with the subject line Lawline Coding Exercise. Please include:

- The link to the github repo
    - https://github.com/Michaeltlee/code-test
- Instructions on how to setup the local site
    - `php artisan serve`
    - 127.0.0.1:8000/products
- Instructions on how to create and seed database tables
    - https://laravel.com/docs/9.x/database#sqlite-configuration
    - [ ] `php artisan migrate`
    - [ ] `php artisan db:seed`
- Instructions on how authentication works
    - [ ] Laravel Sanctum
- Instructions on how to compile assets (if any)
    - [ ] `composer install && npm install`
- Anything else you think is worth mentioning to run the application

Email us for any questions regarding this coding exercise at oiwomark@furthered.com.

![Good Luck](http://www.reactiongifs.us/wp-content/uploads/2014/01/good_luck_morgan_freeman.gif)
