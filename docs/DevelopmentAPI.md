# Development API
This is documentation about Application Programming Interface of FacioCMS which can be used for example in layouts.
You can see all of these in practise inside *Page* Layout

## Getting started
For this article we will use example layout.

## Initializing CMS Session

### What is session
Session is current application runtime session (instance of CMS class). It's used to handle all API methods.

### Initializing
Inside of body.php or head.php add this code
```php
<?php
    use FacioCMS\Client\Session;

    $session = Session::Init($cms); // Don't worry about $cms variable.
?>
```

Your session is ready now.

## Session Methods
+ static function Init(FacioCMS $cms): ClientAPI

## ClientAPI Methods
+ public function GetPage(): Page - returns currently requested page.
+ public function GetAllPages(): Group&lt;Page&gt; - returns all pages as Group.
+ public function GetPageById(int $id): Page|null - returns page by id
+ public function GetSetting(string $name): any - returns cms setting by name

## Page Methods
+ public function GetPage(): Page - returns page
+ public function GetTitle(): string - returns page's title
+ public function GetSubtitle(): string - returns page's subtitle
+ public function GetContent(): string - returns page's content
+ public function GetGallery(): array - returns page's gallery
+ public function GetLink(): string - returns page's url
+ public function GetChildren(): Group&lt;Page&gt; - returns all children as Group.
+ public function GetSiblings(): Group&lt;Page&gt; - returns all siblings as Group.
+ public function GetSetting($name): any - returns page meta key.

## Group Methods
+ public function __construct($items) - class constructor
+ public function All(): array - return all items
+ public function First(): any - return first item
+ public function Last(): any - return last item
+ public function IsEmpty(): bool - return if group has no children
+ public function IsNotEmpty(): bool - return if group has any children
+ public function At($index): any - return item at $index
+ public function Count(): int - return number of children
+ public function Clear(): void - clear group
+ public function PushToStart(): void - push item to start (unshift array)
+ public function PushToEnd(): void - push item to end (push array)