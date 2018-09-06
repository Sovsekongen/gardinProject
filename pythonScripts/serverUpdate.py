#!/usr/bin/python
from updateSQLSensor import update_val, update_stat, clean_stat
from checkTemp import AM2320

am2320 = AM2320(1)
(t,h) = am2320.readSensor()

update_val('tempRoom', t)
update_val('humRoom', h)

update_stat(t, 'tempRoom')
clean_stat()
