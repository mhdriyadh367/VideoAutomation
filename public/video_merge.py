from moviepy.editor import *
from gtts import gTTS
import mysql.connector as mysql
import sys
import time

video_id = str(sys.argv[1])

db = mysql.connect(
    host = "localhost",
    user = "root",
    passwd = "password",
    database = "video_automation"
)

cursor = db.cursor()

query = "SELECT * FROM photos WHERE video_id = "+video_id+" order by id asc"

cursor.execute(query)
results = cursor.fetchall()

videos=[]
for result in results:
	file = 'storage/'+result[4]
	print(file)
	videos.append(VideoFileClip(file))

final_clip = concatenate_videoclips(videos)
name_video = 'assets/video/mv_'+str(time.time())+'.mp4'
place_video = 'storage/'+name_video
final_clip.resize(width=720).write_videofile(place_video, fps=5)

sql = "UPDATE videos SET video='"+str(name_video)+"' WHERE id="+video_id
cursor.execute(sql)
db.commit()

print('success')
