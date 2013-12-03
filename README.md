SlimCMS
=======
It is a CMS created with Slim Framework that doesn't use Database to store the content of the site.

* Powerful and Flexible
* Smaller learning curve than other CMS
* Easy installing
* Separation between Users and Designers
* No Developers needed
* No database needed

1 Getting Started
---------------
1. Get or download the project
2. Install it using Composer

Also you can download the different versions from:
[https://github.com/revuls/SlimCMS/releases](https://github.com/revuls/SlimCMS/releases)
Then Upload the files to your server.

2 Folder System
-------------
* admin/
* content/
* lib/
* themes/
* index.php

2.1 content/
-------------
All the content is stored in this folder using json files.
Structure of the content folder:

blog/
media/
menu/
pages/
config.php

**2.1.1 config.json**

This file contents the Config variables of the Site

```json
{
    "title": "Bootsoft",
    "description": "This is a Great site",
    "user": "admin",
    "password": "d033e22ae348aeb5660fc2140aec35850c4da997",
    "theme": "foundation5",
    "url": ""
}
```
Password encoded in sha1

**2.1.2 pages/**

One json file per Page. Format: {slug}.json

```json
{
    "Template": "template2",
    "Slug": "about",
    "Title": "About page",
    "Description": "Description goes here",
    "Content": "This is the About content",
    "Variables": {
        "Block1": "This is the block 1",
        "Block2": "This is the block 2"
    }
}
```

**2.1.3 blog/**

One json file per Post. Format: {DateTime}_{slug}.json

```json
{
    "Slug": "hello-world",
    "Title": "Hello World",
    "Author": "Cesar Redondo",
    "Date": "11\/26\/2013",
    "Tag": "hello,world",
    "Category": "General",
    "Description": "Description goes here",
    "Content": "This is a hello world example",
    "DateTime": 1385496962
}
```

**2.1.4 menu/**

One json file per Menu (header, footer, sidebar...). Format: {menu_name}.json

```json
{
    "Link1": "http://urlofsite.com/index",
    "Link2": "http://urlofsite.com/page2",
    "Link3": "http://urlofsite.com/page3",
    "Link4": "http://urlofsite.com/page4"
}
```

**2.1.5 media/**

Here we have the images, videos, etc... To be accesible when creating the content of the pages and posts.


2.2 admin/
----------
Simple and easy to use admin tool.
To add content to the site go to: http://your_url/admin

Default Login that can be changed in the config

* User: admin
* Password: admin


2.3 themes/
-----------
Here we have the folders of the different Themes.

Basic structure of one Theme:

```html
{name_theme}/

  css/
  img/
  js/
  layout/
  templates/
  404.html
  article.html
  blog.html
  index.html
  page.html
```

Example of simple page using variables:


```html
<!DOCTYPE html>
<html>
    <head>
        <title>{{config.title}}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>        
        <h1>{{page.Title}}</h1>
        {{page.Content}}
    </body>
</html>
```

The Flexibility and Power of Twig can be used in the templates.
Here you have the official documentation for designers:
[http://twig.sensiolabs.org/doc/templates.html](http://twig.sensiolabs.org/doc/templates.html)

**2.3.1 Variables**

These are the variables that we can use in Themes:


```php
{{config}}
    {{config.title}}
    {{config.description}}
    {{config.user}}
    {{config.theme}}
{{page}}
    {{page.Title}}
    {{page.Slug}}
    {{page.Author}} //In posts of the Blog
    {{page.Date}} //In posts of the Blog
    {{page.Tag}} //In posts of the Blog
    {{page.Category}} //In posts of the Blog
    {{page.Description}}
    {{page.Content}}    
    {{page.Variables}} //In pages only
    	{{page.Variables.nameOfVariable}}
{{blog}}
{{menus}}
{{themes}}
```

2.4 index.php
-------------

All the slim framework routing functionality
This is the routing used in the project:

```php
// Index Page
$app->get('/', function () use ($app) {   
   // Render index.html
});
// Page
$app->get('/:slug', function ($slug) use ($app) {
    // Render page.html
});
// Blog
$app->get('/blog/', function () use ($app) {
    // Render blog.html
});
// Blog Article
$app->get('/blog/:slug', function ($slug) use ($app) {
    // Render article.html
});

```

3 How to Contribute
-------------------

1. Fork the SlimCMS repository
2. Create a new branch for each feature or improvement
3. Send a pull request from each feature branch to the develop branch