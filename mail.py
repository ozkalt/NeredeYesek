#!/usr/bin/python

import smtplib
import os

toaddr = os.environ["mail"]
msg = os.environ["text"]

fromaddr = "computerprojecttwo@gmail.com"
sfr = "CProje2.."

server = smtplib.SMTP('smtp.gmail.com', 587)
server.starttls()
server.login(fromaddr, sfr)

server.sendmail(fromaddr, toaddr, msg)
server.quit()
