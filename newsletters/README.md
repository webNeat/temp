# 2. Sending newsletters

**Files structure**

```
bin/
  worker # check and sends scheduled newsletter email
src/
  Email/
    Email.php # The basic abstract email class
    MultiEmail.php # extends the Email class and adds the possibility to
                   # add/remove subscribers lists and sent to all subscribers
    Newsletter.php # The newsletter class, extends MultiEmail and adds
                   # possibility to schedule the email.
    Notification.php # exends MultiEmail and can be notified from an Event
                     # with a new content to send.
    WelcomeEmail.php
  Event.php # A simple abstract event class to demonstrate Notification Emails.
  Send.php  # Defines the way to send emails (showing to console, ...)
  Subscriber.php
  SubscriberList.php
```

**Tests**

I have used `Codeception` to write tests since it helps to write acceptance tests and easily test the output of a script.

- `tests/unit`: Unit tests
- `tests/cases`: Acceptance tests cases

**Notes**

- Since no Database is used, the `bin/worker` script is not complete.
- Some notes and explanation can be found the comments inside the code.