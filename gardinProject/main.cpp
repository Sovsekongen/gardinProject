#include <iostream>

#ifdef _WIN32
#include <io.h>
#else
#include <unistd.h>
#endif

#include "SerialPort.hpp"

using namespace std;
using namespace rwhw;


int main()
{
    SerialPort serial;
    serial.open("COM5", SerialPort::Baud9600, SerialPort::Data8, SerialPort::None, SerialPort::Stop1_0);

    // Flush
    serial.clean();

    for (unsigned char i = 0; i < 255; ++i)
    {
        char c[1];
        c[0] = '5';//static_cast<char>(i);
        serial.write(c, 1);
        Sleep(100);
        char buf[128];
        serial.read(buf, 1);
        //std::cout << (int) buf[0] << "\t" << (int) buf[1] << "\t" << (int) buf[2] << std::endl;
        //std::cout << static_cast<int>(buf[0]) << std::endl;
        printf("%d\n", (int)buf[0]);
    }

    serial.close();
    system("pause");
}
