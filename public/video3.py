from moviepy.editor import *
from gtts import gTTS
import mysql.connector as mysql
import sys
import time

video_id = str(sys.argv[1])
print(video_id)
db = mysql.connect(
    host = "localhost",
    user = "root",
    passwd = "password",
    database = "video_automation"
)

cursor = db.cursor()

query = "SELECT * FROM photos WHERE id = "+video_id

cursor.execute(query)
result = cursor.fetchall()
hasil = result[0]

music = 'storage/'+hasil[3]
image = ['storage/'+hasil[2]]

print(music)
print(image)

audio_background = AudioFileClip(music)
clip = ImageSequenceClip(image, fps = 1)
clip = clip.set_audio(audio_background)
place_video = 'assets/video/'+str(time.time())+ '_'+str(hasil[0])+'.mp4'
video = 'storage/'+place_video
clip.write_videofile(video, fps = 1)

sql = "UPDATE photos SET video='"+str(place_video)+"' WHERE id="+video_id
cursor.execute(sql)
db.commit()

print('success')

