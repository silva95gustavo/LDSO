@echo off
javac -cp ".;java\*;java\lib\*" -encoding UTF-8 -sourcepath java\. java\TestRunner.java
java -cp ".;java\*;java\lib\*;java" TestRunner