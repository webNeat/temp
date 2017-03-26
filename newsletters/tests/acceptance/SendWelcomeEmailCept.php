<?php 
$I = new AcceptanceTester($scenario);

$I->wantTo('send welcome emails to new subscribers');
$I->runShellCommand('php tests/cases/send-welcome-emails.php');
$I->seeInShellOutput(
'Recipient: Lorem <lorem@example.org>
Subject: Welcome

Welcome friend !
---
Recipient: Foo <foo@example.org>
Subject: Welcome

Welcome friend !
---
Recipient: Foo <foo@example.org>
Subject: Get Started

Let\'s write a "Hello World" !
---');