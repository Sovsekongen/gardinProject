import bluepy.btle as btle
import time
 
p = btle.Peripheral("E0:E5:CF:77:F3:C3")
s = p.getServiceByUUID("0000ffe0-0000-1000-8000-00805f9b34fb")
c = s.getCharacteristics()[0]
 
c.write(bytes(2))
p.disconnect()
