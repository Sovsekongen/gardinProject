{
  "targets": [
    {
      "target_name": "addon",
	  "include-dirs": [
			"gardinProject/*",
			"C:\Users\vikpo\AppData\Local\Programs\Python\Python36\include"
	  ],
      "sources": [  
			"gardinProject/curtaincontrol.cpp"],
	  "cflags": ["-Wall", "-std=c++11", "-I."],
	  "xcode_settings": {
		"OTHER_CFLAGS": [
		"-std=c++11"
		]
	  }
    }
  ]
}