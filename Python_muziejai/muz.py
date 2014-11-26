__author__ = 'root'
# -*- coding: utf-8 -*-
from bs4 import BeautifulSoup
import MySQLdb
from config import *
import urllib2
import codecs

expos_url = 'http://www.muziejai.lt/Aktualijos/naujos_parodos.asp'
start_url = 'http://www.muziejai.lt'

def cities():
    with codecs.open('miestai', 'r', encoding='utf-8') as f:
        return [i.replace('\n', '') for i in f.readlines()]

def insert(query, values):
    db = MySQLdb.connect(host="localhost", user=USER, passwd=PASSWORD, db=DATABASE, charset="utf8")
    cursor = db.cursor()
    cursor.execute(query, values )
    db.commit()
    db.close()
    return cursor.lastrowid

def get(query):
    db = MySQLdb.connect(host="localhost", user=USER, passwd=PASSWORD, db=DATABASE, charset="utf8")
    cursor = db.cursor()
    cursor.execute(query)
    db.commit()
    db.close()
    return  cursor.fetchone()

def get_soup_from(link):
    source = urllib2.urlopen(link).read()
    return BeautifulSoup(source)


def get_expo_links():
    soup = get_soup_from(expos_url)
    urls = [i['href'].replace('..', '') for i in soup.find_all('a') if i.has_attr('href') and i.text == u'Išsamiau »']
    return urls

all_cities = cities()
def get_info(link):
    soup = get_soup_from(link)
    anonsas = soup.find('div', {'class': 'anonsas'})
    p_tags = anonsas.find_all('p')[:3]
    name = p_tags[0].text
    address = p_tags[1].text
    city = address.split(',')[-1].strip()
    print city
    if city in all_cities:
        time = p_tags[2].text.split('Atidarymas')[0]
        get_q = '''SELECT id from Expo WHERE name = "%s" ''' % (name)
        get_db = get(get_q)
        if get_db == None:
            insert_q = '''INSERT INTO Expo(name, address, time, link, city) VALUES (%s, %s, %s, %s, %s)'''
            values = (name, address, time, link, city)
            insert(insert_q, values)

def main():
    for i in get_expo_links():
        get_info(start_url + i)



if __name__ == '__main__':
    print "pradedam tikrinti"
    main()
    print "pabaiga"