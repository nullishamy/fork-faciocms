# Pages (website content)

FacioCMS Page can be created as a child of other page.
For example page *tutorials* could have child-page *getting started*.
Also page can be created in website root (page have not any parent), and it's named "top-level page"

## Creating "top-level" page
Inside of your admin panel go to **Pages** and click **Create Page +** and your page will be created.

## Creating page as a child
Inside of pages list find page that you want to have child and click the **+** button at the right of it.

## Editing page
To edit your page click on it's name or button with pen icon.

## Setting up the page
Inside page editor you need to:
+ Set proper page's layout (category: Basic)
+ Set proper page's url (category: Basic)

## Page url
The *url* property is the path that you use to visit this page. It is stackable (if page have parent then parent's url will be before it's url)
Examples:
+ For "top-level" page when you will set url to **test-url** this page will be accessible at **https://your.page.url/test-url**
+ For child of this "top-level" page which has url set to **test-123** this page will be accessible at **https://your.page.url/test-url/test-123**

## Layout
The layout is page template that cms uses to generate your website view.

## Settings
Settings or "meta-keys" are simple way to transfer data into your layout.
Each page has built-in keys:
+ Active (if it is set to false then the page cannot be accessed via api or visited)
+ Index (index by searcher)
+ Follow links (follow links by searcher)
+ Is home (Home page is page that will be shown when someone enter website without additional path (https://your.page.url). Only 1 page can have this set to true)
+ Title ("title" tag in html)
+ Description (meta description tag)
+ Author (meta author tag)

You can also create your own keys (e.g. CHAT_GPT_API_KEY) which will be easily accessible later while generating your website.

**Important: ** you can create "secret" meta keys (settings) adding "$" prefix before name. It will be hidden from normal users (only admin can change or see them). They can be used e.g. by plugins or to store some api keys etc.

## Gallery
You can import and delete images there. Later while generating website for user you can easily access them inside your layout.