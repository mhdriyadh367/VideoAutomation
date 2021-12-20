from gtts import gTTS
import sys
import mysql.connector as mysql

photo_id = str(sys.argv[1])

db = mysql.connect(
    host = "localhost",
    user = "root",
    passwd = "password",
    database = "video_automation"
)

cursor = db.cursor()

query = "SELECT * FROM photos WHERE id = "+photo_id

cursor.execute(query)
result = cursor.fetchall()
hasil = result[0]

music = 'storage/'+hasil[3]
mytext = hasil[5]

language = 'id'

tts = gTTS(text=mytext, lang=language, slow=False)
tts.save(music)

db.commit()