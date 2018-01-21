# HBTUMAIL

gitter-badge-1
[![Join the chat at https://gitter.im/DhawalAgrawal/HBTUMAIL](https://badges.gitter.im/DhawalAgrawal/HBTUMAIL.svg)](https://gitter.im/DhawalAgrawal/HBTUMAIL?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

> A Webmail service to connect faculty and students of HBTU Kanpur. http://hbtumail.decoder.co.in/

# License
This repository is licensed under GNU General Public License v3.0

## How to Setup

Setting up HBTUMAIL on your local machine is really easy.
Follow this guide to setup your development enviroment.

### Requirements :

1. PHP > 5.6
2. MySQL
3. XAMPP
4. Adobe Dreamweaver
5. git


### Installation :

1. Get the source code on your machine via git.

	```shell
    git clone https://github.com/DhawalAgrawal/HBTUMAIL.git
    ```

2. Install VOZ

	```
	Copy all the files to the htdoccs folder of Xampp server
	```

3. Setting up the Dreamweaver.

	```
	Open the index.php page in Dreamweaver
	 Click files on the right side of the window
   Manage sites
   New
   Site name HBTUMAIL
   Local root folder < path\xampp\htdocs\HBTUMAIL\
   HTTP Address < http://localhost/HBTUMAIL/
   Server-Mode PHP MySQL
   Access LOCAL/NETWORK
   Testing server folder < path\xampp\htdocs\HBTUMAIL\
   URL prefix < http://localhost/HBTUMAIL/
   OK
	```


4. Create an empty sql database and run import database.

	```
	Start MySQL as Admin in XAMMP
	Create new database called HBTUMAIL
	import database < path\HBTUMAIL\sql\HBTUMAIL.sql
	```

That's it, now start development at [http://localhost/HBTUMAIL/index.php](http://localhost/HBTUMAIL/index.php) in your browser

## Contribution guidelines

If you are interested in contributing to HBTUMAIL, Open Issues, send PR and Don't forget to star the repo.
> Feel free to code and contribute
