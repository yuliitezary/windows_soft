goto start   // ������ �����������
--------------------------------------
https://www.youtube.com/user/JavaNNiMON/videos

����������� ����� ������� � 5 ������� - ������������������ 15 ������
ffmpeg -i 1.mp4 -ss 00:00:05 -codec copy -t 00:00:15 out.mp4
--------------------------------------
����������� 1 ������ 27 ������ - � ����� �����
ffmpeg -sseof -00:01:27 -i 1.mp4 -c copy out.mp4
--------------------------------------
�������������� ����� �������� .flv � .avi  ������� ������������� � ��������� .ts
ffmpeg -i 1.flv -acodec copy -vcodec copy -vbsf h264_mp4toannexb -f mpegts 11.ts
ffmpeg -i "concat:11.ts" -vcodec copy -acodec copy out.avi
--------------------------------------
������� 3 ���������� MP4   ������� ������������� � ��������� .ts
ffmpeg -i 1.mp4 -acodec copy -vcodec copy -vbsf h264_mp4toannexb -f mpegts 11.ts
ffmpeg -i 2.mp4 -acodec copy -vcodec copy -vbsf h264_mp4toannexb -f mpegts 22.ts
ffmpeg -i 3.mp4 -acodec copy -vcodec copy -vbsf h264_mp4toannexb -f mpegts 33.ts
ffmpeg -i "concat:11.ts|22.ts|33.ts" -vcodec copy -acodec copy out.mp4
--------------------------------------
����������� � 10 ������� � ������ �����
ffmpeg -ss 00:00:10 -i 1.mp4 -c copy out.mp4
--------------------------------------
������� ����� �� ������. ������ ����� FOTO ������ ����� ffmpeg -  ffmpeg\FOTO 
�������� ������� SHIFT - ������ ����� ffmpeg, ������ �������� ����� �������� ����, ������ �������� "������� ���� ������" - ��������� ��������� ������ - ��������� �������
ffmpeg -i 1.mp4 FOTO/image%d.png 
��� ENTR

--------------------------------------
������ ������
ffmpeg.exe -y -rtbufsize 100M -f gdigrab -framerate 30 -probesize 10M -draw_mouse 1 -i desktop -c:v libx264 -r 30 -preset ultrafast -tune zerolatency -crf 25 -pix_fmt yuv420p screen.mp4
--------------------------------------
�������� ���������� ����� ��� ��������������� (0, 90, 180, 270) 
ffmpeg -i 1.mp4 -codec copy -map_metadata 0 -metadata:s:v:0 rotate=0 0.mp4
--------------------------------------
�������������� ����� � ����� � ���������
ffmpeg -i 1.mp3 -i 1.PNG -c copy 1.avi
--------------------------------------
--------------------------------------
// ����� �����������
:start 

ffmpeg -i 1.mp4 -codec copy -map_metadata 0 -metadata:s:v:0 rotate=0 0.mp4





