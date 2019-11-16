# PyNet Speed Logger

A network speed logger written in Python that logs network speeds to a MySQL database using a Raspberry Pi. Accessible through a web UI. Version 1.0A. Runs once every hour using a Crontab job. The web UI displays the logged data for the last 7 days (will be customizable in the future).

## Prerequisites

You'll need a Raspberry Pi, preferably version 3, Python 3, PHP 7, apache2 and MySQL installed. There are separate tutorials to install these. Most can be found at http://www.pimylifeup.com/. You'll also need to set this up as a Crontab job so that it runs hourly. The setup is pretty manual, but after the initial setup, it pretty much runs itself. More customization options and better versions with filters and more features will be available in the future.

##Instructions

* First thing you'll need to do is tun the PyNet.sql file to create the database, table and view. Python inserts into the table, while the web UI reads from the view.

* Next, you'll need to schedule the Crontab job to run the Python script, pynet.py, once per hour. This can be done by setting the job's hours to 0 * * * *. Make sure you point it to the correct path!

## Author(s)

* [Zollern Wolf](https://github.com/alphawolf918/)

## License

* GNU Public License