// rich text editor
$("#textbox").redactor({
	minHeight: 150,
	placeholder: "Your thoughts?",
	toolbarFixed: true,
	toolbarFixedTarget: '#post-textbox',
	imageUpload: '/upload.php',
	fileUpload: '/upload.php',
	formattingAdd: {
	  "align-left": {
	    "title": "Align Left",
	    "args": ["p","class","align-left"],
	  },
	  "align-right": {
	    "title": "Align Right",
	    "args": ["p","class","align-right"],
	  },
	  "align-center": {
	    "title": "Align Center",
	    "args": ["p","class","align-center"],
	  },
	},
});