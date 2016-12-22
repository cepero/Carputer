#!/usr/bin/env python
import uinput
import time
import requests
from xbmcjson import XBMC, PLAYER_VIDEO
import subprocess

device = uinput.Device([
        uinput.KEY_ESC,
	uinput.KEY_ENTER,
	uinput.KEY_UP,
	uinput.KEY_DOWN,
	uinput.KEY_RIGHT,
	uinput.KEY_LEFT
	])

session = requests.Session()
xbmc = XBMC("http://localhost:8080/jsonrpc")

while 1:
	last=0
	with open("/var/www/html/carputer/words.log", "rb") as f:
		first = f.readline()
		for last in f: pass
	if last == "POLO\n": #Comando de activacion: OKEY POLO
		numLinesViejo = 0
		operando = False
		r = session.post('http://localhost/carputer/cache.php', data = {'escuchando':'true'})
		
		while 1:
			with open("/var/www/html/carputer/words.log", "rb") as f:
		        	first = f.readline()
               			for numLines, last2 in enumerate(f): pass

			if(numLines != numLinesViejo):
				operando = True
				numLinesViejo = numLines
			else:
				operando = False

			#Se comprueba si Kodi esta abierto para actuar en consecuencia
			modoKodi = False
			try:
				ps = subprocess.Popen(('ps', '-A'), stdout=subprocess.PIPE)
				output = subprocess.check_output(('grep', 'kodi'), stdin=ps.stdout)
				modoKodi = True
			except subprocess.CalledProcessError, e:
				#print "Excecption"
				pass

			if last2 == "END\n": #Comando de desactivacion: END
				r = session.post('http://localhost/carputer/cache.php', data = {'escuchando':'false'})
				break
			if last2 == "UP\n" and operando == True:
				if(modoKodi):
					print "UP en Kodi"
					xbmc.Input.Up()
				else:
					print "UP"
					device.emit_click(uinput.KEY_UP)
			elif last2 == "DOWN\n" and operando == True:
				if(modoKodi):
					print "DOWN en Kodi"
					xbmc.Input.Up()
				else:
					print "DOWN"
					device.emit_click(uinput.KEY_DOWN)
			elif last2 == "RIGHT\n" and operando == True:
				if(modoKodi):
					#print "RIGHT en Kodi"
					xbmc.Input.Right()
				else:
					print "RIGHT"
					device.emit_click(uinput.KEY_RIGHT)
			elif last2 == "LEFT\n" and operando == True:
				if(modoKodi):
					print "LEFT en Kodi"
					xbmc.Input.Left()
				else:
					print "LEFT"
					device.emit_click(uinput.KEY_LEFT)
			elif last2 == "ENTER\n" and operando == True:
				if(modoKodi):
					print "ENTER en Kodi"
					xbmc.Input.Select()
				else:
					print "ENTER"
					device.emit_click(uinput.KEY_ENTER)
			elif last2 == "SCAPE\n" and operando == True:
				if(modoKodi):
					print "SCAPE en Kodi"
					xbmc.Input.Back()
				else:
					print "SCAPE"
					device.emit(uinput.KEY_ESC,1)
					time.sleep(1)
					device.emit(uinput.KEY_ESC,0)
			elif last2 == "MOTOR\n" and operando == True:
				print "MOTOR"
				r = session.post('http://localhost/carputer/cache.php', data = {'voiceMode':'motor'})
			elif last2 == "MUSIC\n" and operando == True:
                                print "MUSIC"
                                r = session.post('http://localhost/carputer/cache.php', data = {'voiceMode':'music'})
			elif last2 == "RADIO\n" and operando == True:
                                print "RADIO"
                                r = session.post('http://localhost/carputer/cache.php', data = {'voiceMode':'radio'})
			elif last2 == "SHUTDOWN\n" and operando == True:
				print "SHUTDOWN"
				r = session.post('http://localhost/carputer/cache.php', data = {'voiceMode':'shutdown'})
		time.sleep(0.1)
