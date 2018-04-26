{
  "targets": [
    {
      "target_name": "addon",
	  "include-dirs": [
			"gardinProject/*"
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