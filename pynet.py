import speedtest as spd
import MySQLdb as db
import subprocess as sp

print("Connecting to database...")
sqlCon = db.connect("localhost", "root", "", "PyNet")
print("Connected!")

def getWiFiName():
	PATH = "/bin:/usr/bin:/usr/sbin"
	cmd = sp.check_output("/sbin/iwgetid --r", shell=True)
	return cmd

print("Connecting to SpeedTest...")
speedtester = spd.Speedtest()

print("Getting set of closest servers...")
speedtester.get_closest_servers()

print("Retrieving best possible server...")
speedtester.get_best_server()

megabits = 1048576

print("Calculating download speed...")
downloadSpeed = speedtester.download() / megabits

print("Calculating upload speed...")
uploadSpeed = speedtester.upload() / megabits

downloadSpeed = str(round(downloadSpeed, 2))
uploadSpeed = str(round(uploadSpeed, 2))
wifiNet = str(getWiFiName())

print("--------------")
print("Download Speed: " + downloadSpeed + " Mbps")
print("Upload Speed: " + uploadSpeed + " Mbps")
print("Wi-Fi: " + wifiNet)
print("--------------\n")

curs = sqlCon.cursor()
curs.execute("INSERT INTO PyNet(DownloadSpeed, UploadSpeed, WifiName) VALUES (" + downloadSpeed + ", " + uploadSpeed + ", '" + wifiNet + "');")
sqlCon.commit()
curs.close()
sqlCon.close()
print("Connection closed.")
