<?php 
$I = new AcceptanceTester($scenario);

$I->wantTo('send notification emails when an event is triggered');
$I->runShellCommand('php tests/cases/send-notification-email.php');
$I->seeInShellOutput(
'Recipient: Foo <foo@example.org>
Subject: Awesome Notification

Awesome Notification Content
---
Recipient: Bar <bar@example.org>
Subject: Awesome Notification

Awesome Notification Content
---
Recipient: Baz <baz@example.org>
Subject: Awesome Notification

Awesome Notification Content
---');