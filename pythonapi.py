from urllib2 import Request, urlopen, URLError
import json
import urllib2


response = urllib2.urlopen('http://api.openweathermap.org/data/2.5/weather?q=Istanbul&appid=226dfc5fa3c532974f0bb2bef5249d27')
data = json.load(response)
print data["main"]["humidity"]





"""
request = Request('http://api.openweathermap.org/data/2.5/weather?q=Istanbul&appid=226dfc5fa3c532974f0bb2bef5249d27')

try:
	response = urlopen(request)
    kittens = response.read()
    print kittens
except URLError, e:
    print 'No kittez. Got an error code:'
"""
