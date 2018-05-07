TEMPLATE = app
CONFIG += console c++11
CONFIG -= app_bundle
CONFIG -= qt

SOURCES += \
    curtaincontrol.cpp \
    SerialPort.cpp

INCLUDEPATH += C:\Users\vikpo\.node-gyp\8.11.1\include\node
INCLUDEPATH += C:\Users\vikpo\AppData\Local\Programs\Python\Python36\include

HEADERS += \
    curtaincontrol.h \
    SerialPort.hpp
