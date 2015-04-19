TorqueServer + TorqueClient in Javascript
============

What is this?
-------------

Simply put, it works with the Torque Pro OBDII application on the Google Play store for Android devices. It allows them to send their data here for later storage and live tracking. I wrote it out of boredom while playing with CSS styling and javascript JSON parsing one weekend.

What do I need?
---------------
You'll need:

* PHP
* MySQL or another DBMS. (It's build with MySQL in mind, so anything else will require modification.)
* A browser with Javascript support
* An Android device running Torque to send data from.
* Probably an OBDII adapter? Torque isn't quite as fun without one.
* Wordpress for authentication, though that's configurable if you want to turn that bit off. Again, weekend project.

Installation
------------

You'll need to do the following:

* Place these contents in a directory.
* Move the wordpress\_auth.php one level up, or rewrite the php to get it elsewhere.
* Set the contents of db.php.example to your actual DBMS connection details.
* Rename db.php.example -> db.php
* Get the DB dump into a database on your DBMS.
* Set the Torque application to send data.
