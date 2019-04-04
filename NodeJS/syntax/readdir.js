var testFolder = '../Data/';
var fs = require('fs');

fs.readdir(testFolder, function(err, fileList){
    console.log(fileList);
})