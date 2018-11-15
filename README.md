# ideaz.cloud

[![](https://github.com/vicente-orellana/ideaz.cloud/blob/master/preview.gif)](https://youtu.be/TwqnSCl8SmY)

My CS50 Final Project from 2016. Ideaz.cloud is a web application for online discussion, which uses PHP, SQL, HTML, CSS, AJAX, Javascript, jQuery, and Twitter Bootstrap. The site is much like an online forum in that it allows one to register an account and create threads (also known as "ideaz"), which are sorted in categories that users can freely create. Additionally, users are able to upvote threads; customize their "About Me" page; upload an avatar; and share videos, images, and files.

## Design

Ideaz.cloud is a web application that utilizes a variety of languages and libraries. The languages used were PHP, SQL, Javascript, AJAX, jQuery, HTML, CSS, and Twitter Bootstrap. Below, we will go over the site's features and innerworkings to see what's happening beneath the hood.
## General Layout & Logo
I was aiming to create a site simple to use and easy to navigate. For this reason, I felt using Twitter Bootstrap would be ideal for this task because the library has a variety of built-in features such as tabs, pills, modals, buttons, and icons that would prove to be useful for generating a dynamic and easy-to-use web application.

Initially, I envisioned a platform where users can share their ideas in the form of thought bubbles or thought clouds. This is how I settled for the cloud-themed threads, which was created using one of [Font Awesome's icons](https://fontawesome.com/icons?from=io). Using a bit of CSS, I englarged the icon, placed the relevant text over the icon, and gave it a glowing effect when the user hovers.

The lightbulb icon in the logo naturally stems from this notion. I figured since these thought bubbles pertain to an idea, a lightbulb would be appropriate to portray the creation of new ideas, which is further signified by the glowing effect when hovering over the logo.

Finally, the sky blue theme is both a matter of personal preference as well as relevance to the theme of the website. I wanted to make the site seem as though it were floating in the sky of countless ideas.

## Threads/Ideaz

Much like the general layout, I wanted the thread page to be simple to use and understand. I based the design off of Skype, which I constantly use to speak and chat with my friends. I liked the idea of live updates, where one does not have to refresh the page in order to see new content. In order to accomplish this, I used AJAX and jQuery. I set an interval so that every few seconds, a new request is made to the server; if the returned HTML of the page happens to be different than its current HTML, the comments section will update automatically (briefly showing a neat AJAX spinner). The same method was applied to other pages where live updates are performed, such as on the "Big Ideaz", "New Ideaz", and "Categories" pages.

## Upvotes

One feature I enjoyed implementing was the upvote feature, which is displayed in the form of a lightbulb icon on each thread. This was accomplished using a combination of jQuery and PHP/MySQL. Whenever a user clicks the lightbulb, their user id is added to a column in the "threads" table of the database called "vote_users". This is how I ensured a user would only be able to vote once per thread. If their id is already in that list, the lightbulb icon will glow. If they click the lightbulb again, their user id is removed from the list and the lightbulb will no longer glow. Additionally, the website keeps track of how many votes each thread has, incrementing or decrementing via PHP and SQL each time a user upvotes or retracts their upvote.

## Text Editor

The amazing WYSIWYG text editor, which is the centerpiece of the thread page, was implemented using Imperavi's jQuery library, which is called Redactor 2. While it's not free, it is definitely worth the price for allowing users to share and upload files, videos, and images. I was excited to know that Youtube links are automatically converted to an HTML embed. I am also fond of the customization of the toolbar and how easy it is to implement the text editor on any page. (Proprietary file not included)

I was able to incorporate this text editor into the posts by selecting the div in jQuery and using AJAX to send data to the server, where files would be stored in /uploads/ and the text would be stored in the database in HTML format to preserve its special content. I used this same method in other areas of the site, such as for the "About Me" section of the User CP.

## Drag-and-Drop Uploads (Avatars)

The drag-and-drop feature for the avatar section of the User CP was created using a Javascript library called Dropzone.js. Incorporating this feature was rather straightforward, though I also had to create an additional PHP file for handling uploads and sending back a JSON response. If an error occurred due to an inappropriate file extension or if the user exceeded a certain file size, a JSON array with the key "error" would be filled and sent back to the AJAX request, which would display it in the same page. This is essentially how I handled other forms as well, such as the login and register forms: jQuery would use AJAX to send data to the PHP file used for verification, and if an error were detected, login or registration would be impeded and the error message in the array would be displayed instead.

## Infinite Scroll

I wanted to add the infinite scroll feature to make the site appear more organized and less cluttered as the number of posts and users increased. This feature, as demonstrated on virtually every page, was accomplished via a combination of jQuery, AJAX, PHP, and SQL. I used an online tutorial from SmartTutorials to create this effect. First, I limited the number of posts, threads, categories, or users displayed on a page using SQL's LIMIT argument. Then, using a few inputs containing the "starting point" and the "limit" for the next round of displayed content each time a user scrolls to the bottom of the page, I used AJAX to send that data to the PHP file called ajax.php (or similar, depending on the page)--located in /templates/ajax/. The values of these updated inputs would be used as arguments in each subsequent SQL statement to display the next round of data to be appended to a div on the page.

## Edit/Delete Posts

Finally, to allow users to edit and delete posts, I added an input in the post loop that checks if the post is the current user's or if the current user is an administrator (set using the session superglobal). If so, the user is allowed to edit the post, which displays another Redactor textbox over the content, and updates the post using edit.php. If the user wishes to delete the post, the post's id is sent to remove.php to be removed from the database while updating various user and thread count information.
