#!/usr/bin/env python
import uinput
import time

device = uinput.Device([
	uinput.KEY_D,
	uinput.KEY_LEFTALT,
	uinput.KEY_LEFTCTRL,
	uinput.KEY_LEFTSHIFT
	])

time.sleep(1)
device.emit(uinput.KEY_LEFTALT,1)
device.emit(uinput.KEY_LEFTCTRL,1)
device.emit(uinput.KEY_D,1)

device.emit(uinput.KEY_LEFTCTRL,0)
device.emit(uinput.KEY_D,0)
device.emit(uinput.KEY_LEFTSHIFT,0)
