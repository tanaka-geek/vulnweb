# What is this?

This is a free, vulnerable web application built with OWASP TOP10 vulnerabilities.

The web app is written in PHP and it's very simply written in MVC model.

# Setting up the app

run the following commmand on terminal and access `http://localhost:8000`.

```bash
git clone https://github.com/wacker928/vulnweb.git & cd vulnweb
cd docker && docker compose up 
```

admin creds -> `admin:admin`

all the poc codes are stored in  `/script`.

# OWASP TOP10

- [x] XSS (reflective/stored/DOM: insert value is HTML tag, event handler, JavaScript) -> dashboard konnichiwa $username string not sanitised
- [x] SQL injection (also blindSQLi)
- [x] OS command injection -> /users/upload.php LFI->RCE possible
- [x] XXE Injection:  /users/xml.php
- [x] NoSQLi: /searchId.php?id=1
- [x] Open Redirect -> New functionality (UI) dashboard.php?url where header() is executed from client input (html embed).
- [x] Directory Traversal -> include() with dashboard's new functionality
- [x] Local File Inclusion -> include() with new dashboard functionality + PHP wrapper, .php files can also be displayed
- [x] File Uploading leads to code execution -> /users/upload.php 
- [x] Forced Browsing -> Directory Listing, due to the lack of .htaccess file existing.
- [x] IDOR (Privilege Escalation)
- [x] IDOR (Lateral)
- [x] CSRF 
