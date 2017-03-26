## 1. Code Review

A page within the newsletter system was needed to display an in-browser preview of a newsletter.
The preview needs to display newsletter's subject, HTML body and a link to the preview itself for sharing with others.
A fellow developer wrote this piece of code to do the job and is asking you to review it.

What do you think of it? Are there any issues you see? Please describe your evaluation of this code.
Would you write it differently? If so, please rewrite it to meet your standards and explain the reasoning behind any changes.

```
<?php
mysql_connect('localhost', 'root', '');
mysql_select_db('mycorp');
$id = $_GET['id'];
$query = mysql_query("SELECT * FROM newsletters WHERE id='" . $id . "'");
while ($newsletter = mysql_fetch_assoc($query)) {
  echo '<h3>' . $newsletter['subject'] . '</h3>';
  echo $newsletter['body'];
  echo 'You are viewing <a href="' . $_SERVER['PHP_SELF']. '?id='. $_GET['id'] . '">This newsletter</a>';
}
```

## 2. Sending newsletters
We would like to see how you solve an OO design problem.
Let's create a simple newsletter email system.
The goal is to emulate sending newsletters to subscribers.

There are 3 business entities:

- `Subscriber` - has a name and an email address
- `List` - has a name and is a list of subscribers. Subscribers can subscribe to a list, and there can be many subscribers in a list.
- `Email` - has a subject and a body. Usually emails are sent to subscriber lists.
  There can be several different types of emails:
  * `Newsletter` - can be sent to multiple lists. Newsletters may be sent out immediately or scheduled to be sent at a later time.
  * `Welcome email` - they are sent only to new subscribers when they subscribe to specified list(s). One welcome email may send to multiple lists, and one list may have multiple welcome emails.
  * `Notification email` - they are sent out to one or multiple lists, sending is triggered by an outside event, e.g. new content is published, and new content is usually displayed within the email (e.g. as a digest of recent articles).

One should be able to create each type of email and send it to two lists with two subscribers each.

Notes:
- Having a DB is optional;
- Actually sending emails is optional. Displaying contents on screen is perfectly fine.
  Sample output could look like this:
```
Recipient: Jack <jack@example.org>
Subject: Good morning
    
Good morning and have a nice day!
- Jill
```

- Please add automated tests.
- Please use plain PHP for this test.

## 3. Newsletter Renderer
Newsletter emails these days can be quite fancy, containing images, buttons, text, multi-column layouts.
Let's build a system to display a simple newsletter with Javascript.

A newsletter consists of a set of content blocks, and may be described as a JSON structure. The format of data structures is up to you.
Content blocks can be of different types, e.g. text, images, videos, dividers, and may have different settings (e.g. image URL, dimensions, alt text). But for this test let's use only text and image blocks.

The idea is to take a newsletter JSON structure as an input.
The JSON structure would contain an arbitrary configuration of different block types and their layouts.
Your system should render the email in HTML to be displayed in the browser.

Notes:
- Please make sure to add tests;
- Please implement this in plain Javascript.

Here are some sample email structures to give you a better idea of the end result:

```
-----------------------
|  image   |   image  |
-----------------------
| text text text text |
| text text text text |
-----------------------
| text | text | image |
-----------------------
```

```
-------------------------
|         image         |
-------------------------
|    text   |   image   |
-------------------------
| image | text  | image |
-------------------------
|  text text text text  |
-------------------------
```

```
-------------------------
|         text          |
-------------------------
|         image         |
-------------------------
|  text text text text  |
|  text text text text  |
-------------------------
|         text          |
-------------------------
```
