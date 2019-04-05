/*
function a() {
    console.log('A');
}
*/

var a = function (char) { // 익명함수
    console.log(char);
}

function slowFunc(callback){
    callback('A');
}

slowFunc(a);