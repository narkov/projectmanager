--------------------------------------------------------------------------------
NarkozaTEAM Project Manager
--------------------------------------------------------------------------------

Project manager is kind of application that may be very useful to help 
organizing several aspects of software development projects, especially 
when the projects are complex and involve several people.

This package provides the base for a solution that may be further 
developed over time to address many of the needs of non-trivial software 
development projects.

--------------------------------------------------------------------------------
REQUIREMENTS
--------------------------------------------------------------------------------

NarkozaTEAM Project Manager requires 
- PHP 4.1.2 or better.  
- WACT 0.0.2a
- RDBMS (SQLite, MySQL, PostgresSQL, Oracle, Interbase, etc)
It has been tested on 4.1.2, 4.3.8, 4.3.9, 5.0.1 and 5.0.2

--------------------------------------------------------------------------------
CONFIG.INI
--------------------------------------------------------------------------------
In root folder you will find the file config.ini. This the central
configuration file. Here you can specify which database driver and RDMBS you 
want to use.

Some important settings in config.ini

[templates]
forcecompile = TRUE | FALSE

[database]
; which database driver to use.
driver = mysql | pear | adodb

;Mysql settings
mysql.database = "narkozateam"
mysql.user = "narko"
mysql.password = "narko"
mysql.host = "localhost"


--------------------------------------------------------------------------------
!!! IMPORTANT !!!
--------------------------------------------------------------------------------
Your PHP installation will need write access to a 'compiled' directory under
every 'templates' directory in order for the program work.


--------------------------------------------------------------------------------
CONTACT
--------------------------------------------------------------------------------
Please feel free to contact me with any comments, suggestions, bug fixes
criticism, or just a happiness messages.

If you run into any problems while trying to configure these scripts
first read this file carefully, if you don't find any solution, send me a Mail.
