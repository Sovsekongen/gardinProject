import os
import sys
from bluetooth.ble import DiscoveryService

print("Hello World")
file = open("testfile.txt", "w")
 
file.write("Hello World") 
 
file.close()
# bluetooth low energy scan


service = DiscoveryService()
devices = service.discover(2)

for address, name in devices.items():
    print("name: {}, address: {}".format(name, address))