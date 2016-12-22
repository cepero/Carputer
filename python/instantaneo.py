#!/usr/bin/env python

import obd_io
import serial
import platform
from datetime import datetime
import time
import getpass
import requests



class OBD_Recorder():
    def __init__(self, log_items):
        self.port = None
        self.sensorlist = [12,13,17]
			
    def connect(self):
        portnames = ['/dev/rfcomm0']
        for port in portnames:
            self.port = obd_io.OBDPort(port, None, 2, 2)
            if(self.port.State == 0):
                self.port.close()
                self.port = None
            else:
                break

        if(self.port):
            print "Connected to "+self.port.port.name
            
    def is_connected(self):
        return self.port
            
    def record_data(self):
        if(self.port is None):
            return None
	session = requests.Session()
        print "Time, RPM, Speed, Throttle"

	while 1:
            localtime = datetime.now()
            current_time = str(localtime.hour)+":"+str(localtime.minute)+":"+str(localtime.second)
            log_string = current_time
            for index in self.sensorlist:
                (name, value, unit) = self.port.sensor(index)
                log_string = log_string + ","+str(value)
	    print (log_string+"\n")
	    r = session.post('http://localhost/carputer/cache.php', data = {'obd':log_string})	
	    time.sleep(0.05)
	

logitems = ["rpm", "speed", "throttle_pos"]
o = OBD_Recorder(logitems)
o.connect()
o.record_data()
