## Prerequisites
- Before you begin, ensure you have met the following requirements:

- PHP 8.1
- Composer 2.3.10
- Laravel 10.10

## Installation
- Clone this repository: git clone https://github.com/EzmemmedQasimov/News-management.git
- Navigate to the project directory: cd News-management
- Install Composer dependencies: composer install
- Create a copy of the .env.example file and rename it to .env.
- Generate an application key: php artisan key:generate

## Configuration

- DB_DATABASE: Configure database name at .env file
- DB_USERNAME: Configure mysql username at .env file
- DB_PASSWORD: Configure mysql password at .env file

## Usage

- php artisan migrate
- php artisan serve


## Routes

1. Get All News
- Endpoint: /api/news
- Method: GET
- Controller Method: NewsController@index
- Description: Retrieve a list of all news articles.


2. Get a Single News
- Endpoint: /api/news/{id}
- Method: GET
- Controller Method: NewsController@show
- Description: Retrieve details of a specific news article identified by its {id}.


3. Create a New News Article
- Endpoint: /api/news
- Method: POST
- Controller Method: NewsController@store
- Description: Create and store a new news article.


4. Update an Existing News Article
- Endpoint: /api/news/{id}
- Method: PUT
- Controller Method: NewsController@update
- Description: Update an existing news article identified by its {id}.


5. Delete a News Article
- Endpoint: /api/news/{id}
- Method: DELETE
- Controller Method: NewsController@delete
- Description: Delete a news article identified by its {id}.


## Validation Rules

For creating and updating news data, the following rules are applied:

1. Title:

- Required
- Minimum length: 3 characters

2. Description:

- Required
- Minimum length: 10 characters

3. Language Code:

- Required
- Custom rule: The language code must be one of the supported languages: az, en, ru

4. Status:

- Required
- Must be either 0 or 1


## Language Detection

- The X-Language header from the request is checked to determine the desired language.
- If the specified language is not in the list of supported languages, the default language is set to 'az'.