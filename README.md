# php-telcotools
This repository contains a list of useful PHP class or librairies for teleco related project


## For Sending SMS
For sending SMS, two classes are available for you

###NB
This classes can only be used if you have access to an MSC Gateway

### SMPPClass
This is a base class for sending SMS

### SMSService

This is an implementation of SMPPClass
You it contain one function for sending SMS

#### sendOne(Array $to, string $msg, string $from)

##### $to 
The array of destination numbers you want to send the sms to

##### $msg 
The message you want to send

##### $from 
The name you want the destination numbers to see when receiving the sms
