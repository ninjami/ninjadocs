# Ninjadocs

Simple documentation drom markdown files for Laravel 5

## 1. Install with composer

`composer require ninjami/ninjadocs`

## 2. Create markdown file
Create a new **.md** markdown file in folder **/resources/documentation**

## 3. Add route
Add route to your web routes:
`Route::get('documentation/{fileName}', '\Ninjami\Ninjadocs\NinjadocsController@show');`

Go to `http://app/documentation/{.md files filename}`
