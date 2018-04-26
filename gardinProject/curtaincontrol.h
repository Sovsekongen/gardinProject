#ifndef CURTAINCONTROL_H
#define CURTAINCONTROL_H

#include <node.h>
#include <v8.h>

class curtainControl
{
public:
    curtainControl();

    void closeCurtain(const v8::FunctionCallbackInfo<v8::Value>& args);
    void init(v8::Local<v8::Object> exports);

    static std::string curtainCommand;
};

#endif // CURTAINCONTROL_H
