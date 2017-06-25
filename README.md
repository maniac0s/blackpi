# blackpi
Web Gui for Raspberry Pi Blackcoin staking device

This Web GUI uses CodeIgniter PHP framework and is a very very very alpha version.

Things that are implemented so far:

* Web GUI will get and display your wallet address(es)
** If there is no address (i.e. fresh wallet install), it will create one
* Default wallet account name is 'raspi'
* Display general wallet info
* Display a list of your Transactions
* Send coins to an address

What to do to install this thing:

You neet to set

rpcuser=
rpcpassword=

In your blackcoin.conf

The same username and passwort has to be set in this GUI in

/var/www/blackpi_wg/application/config/blackpi.php

Please note that this GUI is a very! early alpha version!
Backup your wallet.dat and use this GUI with extra care so you lose no coins!

There is no login to the GUI implemented yet. If you need to restrict access, you can use .htacces/Basic Auth in this folder
