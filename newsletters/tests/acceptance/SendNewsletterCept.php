<?php 
$I = new AcceptanceTester($scenario);

$I->wantTo('send a newsletter to one list of subscribers');
$I->runShellCommand('php tests/cases/send-newsletter-to-one-list.php');
$I->seeInShellOutput(
'Recipient: Foo <foo@example.org>
Subject: Hello

Hello World !
---
Recipient: Bar <bar@example.org>
Subject: Hello

Hello World !
---');

$I->wantTo('send a newsletter to two lists of subscribers');
$I->runShellCommand('php tests/cases/send-newsletter-to-two-lists.php');
$I->seeInShellOutput(
'Recipient: Foo <foo@example.org>
Subject: Hello

Hello World !
---
Recipient: Bar <bar@example.org>
Subject: Hello

Hello World !
---
Recipient: Lorem <lorem@example.org>
Subject: Hello

Hello World !
---
Recipient: Baz <baz@example.org>
Subject: Hello

Hello World !
---');

$I->wantTo('send a newsletter to two lists sharing a subscriber');
$I->runShellCommand('php tests/cases/send-newsletter-to-two-lists-with-duplicates.php');
$I->seeInShellOutput(
'Recipient: Foo <foo@example.org>
Subject: Hello

Hello World !
---
Recipient: Bar <bar@example.org>
Subject: Hello

Hello World !
---
Recipient: Baz <baz@example.org>
Subject: Hello

Hello World !
---');
