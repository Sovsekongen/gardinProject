#include <node.h>
#include <v8.h>
#include <iostream>

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

void closeCurtain(const FunctionCallbackInfo<Value>& args)
{
    Isolate* isolate = args.GetIsolate();
    Local<Boolean> retval = Boolean::New(isolate, true);

    demo::curtainCommand = "Close";
    args.GetReturnValue().Set(retval);
}

void openCurtain(const FunctionCallbackInfo<Value>& args)
{
    Isolate* isolate = args.GetIsolate();
    Local<Boolean> retval = Boolean::New(isolate, true);

    demo::curtainCommand = "Open";
    args.GetReturnValue().Set(retval);
}

void init(Local<Object> exports)
{
    NODE_SET_METHOD(exports, "close", closeCurtain);
    NODE_SET_METHOD(exports, "open", openCurtain);
}
NODE_MODULE(addon, init)
}

int main()
{

    while(true)
    {
        if(demo::curtainCommand == "Close")
        {
            std::cout << "Received close command: " << std::endl;
            demo::curtainCommand = "static";
        }
        else
        {
            std::cout << "Received open command: " << std::endl;
            demo::curtainCommand = "static";
        }
    }
    return 0;
}


