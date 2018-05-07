#include <node.h>
#include <v8.h>
#include <iostream>
#include <fstream>

namespace demo
{
static std::string curtainCommand = "static";

using v8::FunctionCallbackInfo;
using v8::Isolate;
using v8::Local;
using v8::Object;
using v8::String;
using v8::Value;
using v8::Boolean; 

char openCom[10] = "Open";
char closeCom[10] = "Close";

std::ofstream myFile;

void writeMessege(char command[5])
{
    myFile.open("example.txt");
    myFile.write(command, 5);
    myFile.close();
}

void callPythonScript()
{
    std::string filename = "./hello-world.py";
    std::string command = "python ";
    std::cout << "tried printing python string" << std::endl;
    command += filename;
    system(command.c_str());
}

void closeCurtain(const FunctionCallbackInfo<Value>& args)
{
    Isolate* isolate = args.GetIsolate();
    Local<Boolean> retval = Boolean::New(isolate, false);

    args.GetReturnValue().Set(retval);
    writeMessege(demo::closeCom);
    callPythonScript();
}

void openCurtain(const FunctionCallbackInfo<Value>& args)
{

    Isolate* isolate = args.GetIsolate();
    Local<Boolean> retval = Boolean::New(isolate, true);

    args.GetReturnValue().Set(retval);
    writeMessege(demo::openCom);
    callPythonScript();
}



void init(Local<Object> exports)
{
    NODE_SET_METHOD(exports, "close", closeCurtain);
    NODE_SET_METHOD(exports, "open", openCurtain);
}

NODE_MODULE(addon, init)
}


