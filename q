Tummelplatz -- a chaotic archive v.0.1

![](media/Tummelplatz.jpg?raw=true)

USE
---

Tummelplatz is a simple single web page for **sharing documents** and **documenting projects** on a web server, for instance on a minicomputer (olimex, raspberri pi) hosted locally on a private network. Think it as dropbox without the cloud, or google drive without login nor password. Files are not ordered (chaos) but Tummelplatz tries to display the metadata they contain (archive). Tummelplatz should work on any web browser on a laptop but also on a mobile phone (useful to quickly create documents projects with pictures). Tummelplatz was created for the (no)action(no)space project, exploring how artists can own their digital infrastructure and share data as collective not individuals. http://noactionnospace.org/

INDEX.php: drag and drop content or click/press in the blank space to upload content

BROWSE.php: delete and manage files

Limitations:
- for the moment, not easy to delete files (might be a feature though)
- metadata displayed on the index page are limited to one field: Jpeg comment
- VIEWER.php not working yet, in the future might display & allow to edit metadata + delete & download file

INSTALL
-------

// dependencies ( exiv2, apache2 )
```
sudo apt install exiv2 apache2 php php-gd libapache2-mod-php

sudo systemctl start apache2
```
(if needed, activate php module in apache) a2enmod php

// configuring php.ini to extend maximum file size to upload
```
vim /etc/php/7.0/apache2/php.ini
```
change this line: post_max_size = 2000M (instead of 2M) 

change this line: upload_max_filesize = 2000M (instead of 2M)

look also in index.php maxFilesize - should be 2000

// installing the PHP files from GIT

git clone then copy as root files in your /var/www/html/ (apache2) or else (other web server)

// create and allow apache to read and write in these dir
```
sudo mkdir uploads/ cache/

sudo chown www-data uploads/ media/logo.png media/logo.png cache/

sudo chmod -R 775 cache/ uploads/
```
// if you want to password protect the access

place a .htpasswd file on the previous rep level (../) containing logn:pwd https://en.wikipedia.org/wiki/.htpasswd

// in case of the hosting of the uploads dir elsewhere (like /mnt/mountpoint/)
```
sudo ln -s /mnt/mountpoint/ uploads ( no / at the end)
```
// if it doesn't work look at Apache2 logs (/var/log/apache2 )
