# Settings
Inside **Settings** in admin panel you can edit your website settings like:
+ Name
+ Url
etc.

## Theme colors
FacioCMS uses these colors and includes them into head of your website. They can be used later to create easily modificable color themes.
Example of style inside head
```html
<style>
    .theme-foreground { color: THEME_COLOR }
    .theme-background { background: THEME_COLOR }
    .secondary-foreground { color: SECONDARY_COLOR }
    .secondary-background { background: SECONDARY_COLOR }
</style>
```

## Minifing website 
To minify your website set *Production mode* inside *Optimalization & Caching* to true.
HTML Response will be automatically minified.

## Super Caching
Super caching can be enabled only in *Production mode*. You can enable it inside *Optimalization & Caching*.

**Warning: ** 
Enabling this feature will disable all PHP functions (because resposne is 100% cached). Example: inside your layout you have code like this:
```php
<?php 
    echo random_int(0, 1000);
?>
```
First time when you will render your page (visit it) the number will be generated (example: 571). Whole HTML response then will be cached on server and next time when visiting this page, this php code won't execute instead automatically 571 number will be show.

## Auto updating
This feature is under development.

## Changing version (introduced in 3.0.1)
Changing CMS version can be done inside *Settings* > *Versions*