var http = require('http');
var fs = require('fs');
var url = require('url');

var app = http.createServer(function (request, response) {
  var _url = request.url;
  var queryData = url.parse(_url, true).query;
  var pathname = url.parse(_url, true).pathname;
  var title = queryData.id;
  if (pathname === '/') {
    fs.readFile(`Data/${title}`, 'utf-8', function (err, description) {
      if (title === undefined) {
        title = 'Welcome';
        description = 'Hello, Node.js';
      }
      fs.readdir('./Data/', function (error, fileList) {
        var list = '<ul>';
        for (var i = 0; i < fileList.length; i++) {
          list += `<li><a href="/?id=${fileList[i]}">${fileList[i]}</a></li>`;
        }
        list += '</ul>';

        var template = `
            <!doctype html>
        <html>
        
        <head>
          <title>WEB1 - ${title}</title>
          <meta charset="utf-8">
        </head>
        
        <body>
          <h1><a href="/">WEB</a></h1>
          ${list}
          <h2>${title}</h2>
          <p>${description}</p>
        </body>
        
        </html>
            `;
        response.writeHead(200);
        response.end(template);
      });
    });
  } else {
    response.writeHead(404);
    response.end('Not found');
  }
});
app.listen(3000);